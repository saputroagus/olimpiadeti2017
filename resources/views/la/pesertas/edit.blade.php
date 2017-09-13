@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/pesertas') }}">Peserta</a> :
@endsection
@section("contentheader_description", $peserta->$view_col)
@section("section", "Pesertas")
@section("section_url", url(config('laraadmin.adminRoute') . '/pesertas'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Pesertas Edit : ".$peserta->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($peserta, ['route' => [config('laraadmin.adminRoute') . '.pesertas.update', $peserta->id ], 'method'=>'PUT', 'id' => 'peserta-edit-form', 'files' => true]) !!}
					{{--@la_form($module)--}}
					
					@la_input($module, 'numid')
					@la_input($module, 'regnum')
					@la_input($module, 'nama')
					@la_input($module, 'gender')
					@la_input($module, 'birthdate')
					@la_input($module, 'school')
					@la_input($module, 'city')
					@la_input($module, 'phone')
					@la_input($module, 'email')
					@la_input($module, 'username')
					@la_input($module, 'about')
					{{-- @la_input($module, 'idcard') --}}
					@la_input($module, 'member')
					{{-- @la_input($module, 'photo') --}}
					@la_input($module, 'status')
					
                    <div class="form-group">
                    <br>
                    <label for="idcard">Kartu Tanda Pelajar* :</label>
                    <input type="file" name="idcard">
                    <br>
                    <label for="photo">Pas Photo* :</label>
                    <input type="file" name="photo">
                    <br>
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/pesertas') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#peserta-edit-form").validate({
		
	});
});
</script>
@endpush
