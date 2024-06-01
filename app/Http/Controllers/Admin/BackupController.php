<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use App\Exports\DevicesExport;
use App\Exports\DossiersExport;
use App\Exports\ActionsExport;
use App\Exports\LaboratoriesExport;
use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BackupController extends Controller
{

    public function ExportDevices()
    {
        return Excel::download(new DevicesExport, 'Devices-data.xlsx');
    }

    public function ExportUsers()
    {
        return Excel::download(new UserExport, 'Users-data.xlsx');
    }

    public function ExportDossiers()
    {
        return Excel::download(new DossiersExport, 'Dossiers-data.xlsx');
    }

    public function ExportActions()
    {
        return Excel::download(new ActionsExport, 'Actions-data.xlsx');
    }
    public function ExportLaboratories()
    {
        return Excel::download(new LaboratoriesExport, 'Laboratories-data.xlsx');
    }

}
