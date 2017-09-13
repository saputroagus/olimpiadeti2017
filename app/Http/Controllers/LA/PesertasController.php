<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use Dwij\Laraadmin\Helpers\LAHelper;

use App\User;
use App\Models\Peserta;
use App\Role;
use Mail;
use Log;
use PDF;


class PesertasController extends Controller
{
	public $show_action = true;
	public $view_col = 'nama';
	public $listing_cols = ['id', 'numid', 'regnum', 'nama', 'gender', 'birthdate', 'school', 'city', 'phone', 'email', 'username', 'about', 'idcard', 'member', 'photo', 'status'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Pesertas', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Pesertas', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Pesertas.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Pesertas');
		if(Module::hasAccess($module->id)) {
			return View('la.pesertas.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new peserta.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	public function getPdf($id){

		$peserta = Peserta::find($id);
		$module = Module::get('Pesertas');
		$module->row = $peserta;
		
		if(($peserta->status == "sudah diverifikasi" && Auth::user()->context_id == $id) || Auth::user()->context_id == 1) {			
			$pdf=PDF::loadView('la.pesertas.invoice', ['peserta'=>$peserta]);

    		$pdf->setPaper('A4', 'potrait');
    		return $pdf->stream('tandabukti.pdf');
		} else {
			return view('la.errors.403', [
					'record_id' => $id,
					'record_name' => ucfirst("peserta"),
				]);
		}		
	}
	
	/**
	 * Store a newly created peserta in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Pesertas", "create")) {
		
			$rules = Module::validateRules("Pesertas", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}

			// generate password
			$password = LAHelper::gen_password();
			
			$insert_id = Module::insert("Pesertas", $request);

			// Create User
			$user = User::create([
				'name' => $request->nama,
				'email' => $request->email,
				'password' => bcrypt($password),
				'context_id' => $insert_id,
				'type' => "Peserta",
			]);
	
			// update user role
			$user->detachRoles();
			$role = Role::find($request->role);
			$user->attachRole($role);

			\Session::flash('success_message', 'Peserta telah ditambahkan');
			
			if(env('MAIL_USERNAME') != null && env('MAIL_USERNAME') != "null" && env('MAIL_USERNAME') != "") {
				// Send mail to User his Password
// 				dd(env('MAIL_USERNAME'));
				Mail::send('emails.send_login_cred', ['user' => $user, 'password' => $password], function ($m) use ($user) {
					$m->from('panitia@olimpiadeti.com', 'Panitia Olimpiade TI 2017');
					$m->to($user->email, $user->name)->subject('Informasi Akun Peserta Olimpiade TI 2017');
				});
				
				Log::info("Informasi akun terkirim. User created: username: ".$user->email." Password: ".$password);
			} else {
				Log::info("Gagal dikirim. User created: username: ".$user->email." Password: ".$password);
			}
			
			return redirect()->route(config('laraadmin.adminRoute') . '.pesertas.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified peserta.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Pesertas", "view")) {
			
			$peserta = Peserta::find($id);
			if((isset($peserta->id) && Auth::user()->context_id == $id) || (Auth::user()->type == "Administrator" || Auth::user()->type == "Panitia")) {
				$module = Module::get('Pesertas');
				$module->row = $peserta;
				
				return view('la.pesertas.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('peserta', $peserta);
			} else {
				return view('la.errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("peserta"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified peserta.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Pesertas", "edit")) {			
			$peserta = Peserta::find($id);
			if((isset($peserta->id) && Auth::user()->context_id == $id && $peserta->status != "sudah diverifikasi") || (Auth::user()->type == "Administrator" || Auth::user()->type == "Panitia")) {	
				if ($peserta->status != "sudah diverifikasi" || Auth::user()->type != "Peserta") {
					$module = Module::get('Pesertas');
				
					$module->row = $peserta;
				
					return view('la.pesertas.edit', [
						'module' => $module,
						'view_col' => $this->view_col,
					])->with('peserta', $peserta);
				} else {
					return view('la.errors.404', [
						'record_id' => $id,
						'record_name' => ucfirst("peserta"),
					]);
				}
			} else {
				return view('la.errors.403', [
					'record_id' => $id,
					'record_name' => ucfirst("peserta"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified peserta in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{

		if(Module::hasAccess("Pesertas", "edit")) {
			
			$rules = Module::validateRules("Pesertas", $request, true);
			$rules['idcard'] = 'image';
			$rules['photo'] = 'image';
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}

			$user = Peserta::find($id);
			if ($request->file('photo') != '') {
				# code...
			$filePhoto = uniqid().'.'.$request->file('photo')->getClientOriginalExtension();
			// Use this
			// $request->file('photo')->move("images", $filePhoto);
			$request->file('photo')->move(public_path('images'), $filePhoto);
			$user->photo = $filePhoto;
			}

			if ($request->file('idcard') != '') {
				# code...
			$fileIDCard = uniqid().'.'.$request->file('idcard')->getClientOriginalExtension();
			$request->file('idcard')->move(public_path('images'), $fileIDCard);
			// Use this
			// $request->file('idcard')->move("images", $fileIDCard);
			$user->idcard = $fileIDCard;
			}

			$insert_id = Module::updateRow("Pesertas", $request, $id);
			
			$user->update();

			return redirect()->route(config('laraadmin.adminRoute') . '.pesertas.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified peserta from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Pesertas", "delete")) {
			Peserta::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.pesertas.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$values = DB::table('pesertas')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Pesertas');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/pesertas/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Pesertas", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/pesertas/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Pesertas", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.pesertas.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}


	/**
     * Change Employee Password
     *
     * @return
     */
	public function change_password($id, Request $request) {
		
		$validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
			'password_confirmation' => 'required|min:6|same:password'
        ]);
		
		if ($validator->fails()) {
			return \Redirect::to(config('laraadmin.adminRoute') . '/pesertas/'.$id)->withErrors($validator);
		}
		
		$peserta = Peserta::find($id);
		$user = User::where("context_id", $peserta->id)->where('type', 'Peserta')->first();
		$user->password = bcrypt($request->password);
		$user->save();
		
		\Session::flash('success_message', 'Password is successfully changed');
		
		// Send mail to User his new Password
		if(env('MAIL_USERNAME') != null && env('MAIL_USERNAME') != "null" && env('MAIL_USERNAME') != "") {
			// Send mail to User his new Password
			Mail::send('emails.send_login_cred_change', ['user' => $user, 'password' => $request->password], function ($m) use ($user) {
				$m->from('panitia@olimpiadeti.com', 'Panitia Olimpiade TI 2017');
				$m->to($user->email, $user->name)->subject('Perubahan Informasi Akun Olimpiade TI 2017');
			});
		} else {
			Log::info("User change_password: username: ".$user->email." Password: ".$request->password);
		}
		
		return redirect(config('laraadmin.adminRoute') . '/pesertas/'.$id.'#tab-account-settings');
	}
}
