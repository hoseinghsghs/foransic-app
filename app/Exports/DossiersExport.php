<?php

namespace App\Exports;

use App\Models\Dossier;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Stevebauman\Hypertext\Transformer;


class DossiersExport implements FromQuery, WithMapping
{
        public function query()
    {
        return Dossier::query();
    }
            public function map($invoice): array
    {

        return [
            [
	'id' ,
	'شماره پرونده',
    'نام پرونده یا کیس',
	'موصوع',
	'مدیریت یا معاونت',
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
	'تاریخ ایجاد',
	'آخرین تاریخ بروز رسانی'],
    [
    $invoice->id,
    $invoice->number_dossier,
    $invoice->name,
    $invoice->subject,
    $invoice->section,
    $invoice->dossier_type == 2 ? 'عملیاتی':' فاوایی',
    $invoice->dossier_case,
    $invoice->expert_phone,
    $invoice->expert_cellphone,
    $invoice->Judicial_number,
    $invoice->Judicial_image,
    $invoice->Judicial_date,
     (new Transformer)->toText($invoice->summary_description),
    $invoice->expert,
    $invoice->is_active== 1 ? 'فعال':'غیر فعال',
    $invoice->is_archive1==0 ? 'فعال':'غیر فعال',
    User::find($invoice->user_category_id)->name,
    $invoice->user_category_id,
    User::find($invoice->personal_creator_id)->name,
    $invoice->personal_creator_id,
    verta($invoice->created_at)->format('Y-n-j H:i'),
    verta($invoice->updated_at)->format('Y-n-j H:i'),
    ],
];
    }


}


