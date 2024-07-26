<?php

namespace App\Exports;

use App\Models\Dossier;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Stevebauman\Hypertext\Transformer;
use Maatwebsite\Excel\Concerns\WithHeadings;


class DossiersExport implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return Dossier::query();
    }
    public function headings(): array
    {
        return
            [
                'id',
                'شماره پرونده',
                'نام پرونده یا کیس',
                'موصوع',
                'مدیریت یا معاونت',
            'حوزه در دست اقدام',
            'کشور',
                'نوع پرونده',
                'کارشناس پرونده',
                'شماره همراه کارشناس پرونده',
                'شماره داخلی کارشناس پرونده',
                'شماره حکم قضایی',
                'تصویر حکم قضایی',
                'تاریخ حکم قضایی',
                'خلاصه پرونده',
                'درخواست کارشناس پرونده از آزمایشگاه',
                'وضعیت',
                'وضعیت آرشیو',
                'رده',
                'رده id',
                'پرسنل ثبت کننده',
                'پرسنل ثبت کننده id',
            'شواهد پذیرش شده',
            'شواهد در حال بررسی',
            'شواهد بررسی  تکمیل شده',
            'شواهد خارج شده',
                'تاریخ ایجاد',
                'آخرین تاریخ بروز رسانی'
            ];
    }
    public function map($dossier): array
    {
        return [
                $dossier->id,
                $dossier->number_dossier,
                $dossier->name,
                $dossier->subject,
            $dossier->section->name,
            $dossier->zone->title,
            $dossier->country,
            $dossier->dossier_type == 0 ? 'عملیاتی' : ' فاوایی',
                $dossier->dossier_case,
                $dossier->expert_phone,
                $dossier->expert_cellphone,
                $dossier->Judicial_number,
                $dossier->Judicial_image,
                $dossier->Judicial_date,
                (new Transformer)->toText($dossier->summary_description),
                $dossier->expert,
                $dossier->is_active == 1 ? 'فعال' : 'غیر فعال',
                $dossier->is_archive1 == 0 ? 'فعال' : 'غیر فعال',
                $dossier->company->name,
                $dossier->user_category_id,
                $dossier->creator->name,
                $dossier->personal_creator_id,
            $dossier->devices->where('status', 0)->count(),
            $val1 = $dossier->devices->where('status', 1)->count(),
            $val2 = $dossier->devices->where('status', 2)->count(),
            $val3 = $dossier->devices->where('status', 3)->count(),
            $dossier->personal_creator_id,
                verta($dossier->created_at)->format('Y-n-j H:i'),
                verta($dossier->updated_at)->format('Y-n-j H:i'),
        ];
    }


}


