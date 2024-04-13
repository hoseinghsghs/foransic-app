<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\User;
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
        $user_category_id=User::find($device->dossier->user_category_id);
        $receiver_staff_id=User::find($device->receiver_staff_id);
        return view('admin.page.prints.printdevice', compact('device' , 'user_category_id' , 'receiver_staff_id'));
      }


}
