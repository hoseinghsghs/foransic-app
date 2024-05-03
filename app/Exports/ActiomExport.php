<?php

namespace App\Exports;

use App\Models\Dossier;
use Maatwebsite\Excel\Concerns\FromCollection;

class ActiomExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Dossier::all();
    }
}
