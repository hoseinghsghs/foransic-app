<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

class PrintController extends Controller
{
    public function prnpriview(Device $device)
    {

        $invoice = Pdf::loadView('admin.page.prints.printdevice', array('device' => $device));
        // Pdf::loadHTML($html)->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf')
        return $invoice->stream();
    }

    public function show(Device $device)
    {
        $receiver_staff_id = User::find($device->receiver_staff_id);
        return view('admin.page.prints.printdevice', compact('device', 'receiver_staff_id'));
    }

    public function printReport(Device $device)
    {
        return view('admin.page.prints.printreport', compact('device'));
    }

}
