<?php

namespace App\Exports;

use App\Models\Device;
use App\Models\Dossier;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Stevebauman\Hypertext\Transformer;

class DevicesExport implements FromQuery, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Device::query();
    }
            public function map($invoice): array
    {
        if ($invoice->status == 0) {
            $invoice->status = "پذیرش شواهد دیجیتال";
        } elseif ($invoice->status == 1){
            $invoice->status = "در حال بررسی";
        }
         elseif ($invoice->status == 2){
            $invoice->status = "تکمیل تجزیه و تحلیل";
        }
         elseif ($invoice->status == 3){
            $invoice->status = "تحویل شواهد دیجیتال";
        }
        $attribute_arry=[];
        foreach ($invoice->category->attributes as $key => $attribute) {
        array_push($attribute_arry, $attribute->name);
        }

        return [
    [
    "id" ,
    "سریال یا شماره اموال شواهد دیجیتال" ,
    "شخص تحویل تحویل دهنده",
    "کد پرسنلی تحویل دهنده",
    "نام تحویل گیرنده",
    "کد پرسنلی تحویل گیرنده",
    "پرسنل آزمایشگاه تحویل دهنده",
    "پرسنل آزمایشگاه تحویل دهنده id ",
    "پرسنل آزمایشگاه تحویل گیرنده",
    "پرسنل آزمایشگاه تحویل گیرنده id",
    "تاریخ و زمان تحویل  دادن شواهد دیجیتال توسط پرسنل آزمایشگاه",
    "تاریخ و زمان تحویل  گرفتن شواهد دیجیتال توسط پرسنل آزمایشگاه",
    "لوازم جانبی",
    "توضیحات و اظهارات درخواست کننده",
    "مشخصات ",
    "شماره خودکار ساز نامه درخواست",
    "تاریخ مکاتبه",
    "تصویر مکاتبه",
    "وضعیت بررسی",
    "وضعیت",
    "وضعیت آرشیو",
    "id پرونده",
    "نام پرونده",
    "دسته بندی",
    "id دسته بندی",
    "تاریخ ایجاد",
	"آخرین تاریخ بروز رسانی"],
    [
    $invoice->id,
    $invoice->code,
    $invoice->delivery_name,
    $invoice->delivery_code,
    $invoice->receiver_name,
    $invoice->receiver_code,
    User::find($invoice->delivery_staff_id)->name,
    $invoice->delivery_staff_id,
    User::find($invoice->receiver_staff_id)->name,
    $invoice->receiver_staff_id,
    $invoice->delivery_date,
    $invoice->receiver_date,
    $invoice->accessories,
    (new Transformer)->toText($invoice->description),
    $invoice->trait,
    $invoice->correspondence_number,
    $invoice->correspondence_date,
    $invoice->primary_image,
    $invoice->status,
    $invoice->is_active== 1 ? 'فعال':'غیر فعال',
    $invoice->is_archive==1 ? 'فعال':'غیر فعال',
    $invoice->dossier_id,
    Dossier::find($invoice->dossier_id)->name,
    $invoice->category->name,
    $invoice->category_id,

    verta($invoice->created_at)->format('Y-n-j H:i'),
    verta($invoice->updated_at)->format('Y-n-j H:i'),
    ],
];
}
}
