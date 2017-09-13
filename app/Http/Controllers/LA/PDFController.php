<?php

namespace App\Http\Controllers\LA;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;

class PDFController extends Controller
{
    public function getPdf()
    {
    	$pdf=PDF::loadView('la.pesertas.invoice');
    	$pdf->setPaper('A4', 'potrait');
    	return $pdf->stream('tandabukti.pdf');
    	// return view('la.pesertas.invoice');
    }
}
