<?php

namespace App\Exports;

use App\Models\Device;
use App\Models\Dossier;
use App\Models\DeviceAttribute;
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
    public function map($device): array
    {
        if ($device->status == 0) {
            $device->status = "پذیرش شواهد دیجیتال";
        } elseif ($device->status == 1){
            $device->status = "در حال بررسی";
        }
         elseif ($device->status == 2){
            $device->status = "تکمیل تجزیه و تحلیل";
        }
         elseif ($device->status == 3){
            $device->status = "تحویل شواهد دیجیتال";
        }
            $value_arry=[
            $device->id,
            $device->code,
            $device->delivery_name,
            $device->delivery_code,
            $device->receiver_name,
            $device->receiver_code,
            User::find($device->delivery_staff_id)->name,
            $device->delivery_staff_id,
            User::find($device->receiver_staff_id)->name,
            $device->receiver_staff_id,
            $device->delivery_date,
            $device->receive_date,
            $device->accessories,
            (new Transformer)->toText($device->description),
            $device->trait,
            $device->correspondence_number,
            $device->correspondence_date,
            $device->primary_image,
            $device->status,
            $device->is_active== 1 ? 'فعال':'غیر فعال',
            $device->is_archive==1 ? 'فعال':'غیر فعال',
            $device->dossier_id,
            Dossier::find($device->dossier_id)->name,
            $device->category->title,
            verta($device->created_at)->format('Y-n-j H:i'),
            verta($device->updated_at)->format('Y-n-j H:i'),
            ];
                $head_arry=[    "id" ,
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
            "id دسته بندی",
            "تاریخ ایجاد",
            "آخرین تاریخ بروز رسانی"];

        foreach ($device->category->attributes as $key => $attribute) {
        $DeviceAttribute=DeviceAttribute::where('attribute_id' ,$attribute->id)->where('device_id' ,$device->id )->get();
        array_push($head_arry, $attribute->name);
        array_push($value_arry, $DeviceAttribute[0]->value);
        };

        foreach ($device->actions as $key => $action) {
        array_push($value_arry,$action->description, $action->start_date , $action->end_date , User::find($action->user_id)->name);
        array_push($head_arry, "اقدام" . $key , "تاریخ شورع اقدام" , "تاریخ پایان اقدام" , "پرسنل ثبت کننده");

        };

        return [
        $head_arry,
        $value_arry,
        ];
    }
}
