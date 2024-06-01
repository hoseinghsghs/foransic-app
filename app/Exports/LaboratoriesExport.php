<?php

namespace App\Exports;

use App\Models\Laboratory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaboratoriesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Laboratory::query();
    }
    public function headings(): array
    {
        return
            [
                'id',
                'نام آزمایشگاه',
                'استان',
                'مکان مستقل',
                'شماره داخلی',
                'تعداد پرسنل ثابت',
                'تعداد پرسنل پاره وقت',
                'تعداد لپ تاپ',
                'تعداد تبلت',
                'نسخه UFED FOR PC',
                'نسخه UFED P-ANALYZER',
                'نسخه OXYGEN',
                'نسخه AXIOM',
                'نسخه FINALMOBILE',
                'سایر توضیحات',
                'تاریخ ایجاد',
                'آخرین تاریخ بروز رسانی'
            ];
    }
    public function collection()
    {
        return Laboratory::all();
    }
}
