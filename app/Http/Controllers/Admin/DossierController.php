<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dossier;

class DossierController extends Controller
{
    public function index()
    {
        return view('admin.page.dossiers.index');
    }

    public function archive()
    {
        return view('admin.page.dossiers.archive');
    }

    public function show(Dossier $dossier)
    {
        return view('admin.page.dossiers.show', compact('dossier'));
    }
}
