<?php

namespace App\Exports;

use App\Models\Action;
use Maatwebsite\Excel\Concerns\FromCollection;

class ActionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            '#',
            'User',
            'Date',
        ];
    }
    public function collection()
    {
        return Action::all();
    }
}
