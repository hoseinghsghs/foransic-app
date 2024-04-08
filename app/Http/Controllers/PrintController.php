<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Barryvdh\DomPDF\Facade\Pdf;
class PrintController extends Controller
{
         public function prnpriview(Device $device)
      {
            $invoice = Pdf::loadView('admin.page.prints.printdevice',array('device'=>$device));
            // Pdf::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf')
            return $invoice->stream();
      }

          public function show (Device $device)
      {

        return view('admin.page.prints.printdevice', compact('device'));
      }


}
