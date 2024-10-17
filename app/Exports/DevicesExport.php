<?php

namespace App\Exports;

use App\Models\Device;
use App\Models\DeviceAttribute;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Stevebauman\Hypertext\Transformer;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DevicesExport implements FromQuery, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Device::query();
    }
    public $device;
    public $value_arry = [];

    public function __construct()
    {
        $this->device = Device::all();
    }

    public function headings(): array
    {
        $head_arry =
            [
                "id",
                "مدل",
                " ورودی -پرسنل آزمایشگاه تحویل گیرنده",
                "ورودی -آی دی پرسنل آزمایشگاه تحویل گیرنده ",
                " ورودی - شخص تحویل دهنده",
                "ورودی - کد پرسنلی تحویل دهنده",
                " ورودی - تاریخ و زمان تحویل  گرفتن شواهد دیجیتال توسط پرسنل آزمایشگاه",
                "خروجی - پرسنل آزمایشگاه تحویل دهنده",
                "خروجی - آی دی پرسنل آزمایشگاه تحویل دهنده  ",
                "خروجی - نام تحویل گیرنده",
                "خروجی -کد پرسنلی تحویل گیرنده",
                "خروجی - تاریخ و زمان تحویل  دادن شواهد دیجیتال توسط پرسنل آزمایشگاه",
                "لوازم جانبی",
                "تجربه نگاری کارشناس فارنزیک در اقدامات",
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
                "تاریخ ثبت",
                "تاریخ ایجاد",
                "آخرین تاریخ بروز رسانی",
                "ویژگی ها"
            ];
        // foreach ($this->device as $device) {

        //     foreach ($device->category->attributes as $key => $attribute) {

        //         array_push($head_arry, $attribute->name);

        //     };
        //     // foreach ($device->actions as $key => $action) {
        //     //     // array_push($value_arry, $action->description, $action->start_date, $action->end_date, User::find($action->user_id)->name);
        //     //     // array_push($head_arry, "اقدام" . $key + 1, "تاریخ شروع اقدام", "تاریخ پایان اقدام", "پرسنل ثبت کننده");
        //     // };
        // }
        return $head_arry;
    }
    public function map($device): array
    {
        if ($device->status == 0) {
            $device->status = "پذیرش شواهد دیجیتال";
        } elseif ($device->status == 1) {
            $device->status = "در حال بررسی";
        } elseif ($device->status == 2) {
            $device->status = "تکمیل تجزیه و تحلیل";
        } elseif ($device->status == 3) {
            $device->status = "خروج شواهد دیجیتال";
        }
        $value_arry_1 = [];
        foreach ($device->category->attributes as $key => $attribute) {
            $attributes = DeviceAttribute::where('attribute_id', $attribute->id)->where('device_id', $device->id);
            if ($attributes->exists()) {
                array_push($value_arry_1, $attributes->first()->value . ":" . $attribute->name);
            } else {
                array_push($value_arry_1, 0);
            }
        };
        $value_arry = [
            $device->id,
            $device->code,
            $device->receiver_staff_id ? User::find($device->receiver_staff_id)->name : " ",
            $device->receiver_staff_id,
            $device->delivery_name,
            $device->receiver_code,
            $device->receive_date,
            $device->delivery_staff_id ? User::find($device->delivery_staff_id)->name : " ",
            $device->delivery_staff_id,
            $device->receiver_name,
            $device->delivery_code,
            $device->delivery_date,
            $device->accessories,
            (new Transformer)->toText($device->description),
            $device->trait,
            $device->correspondence_number,
            $device->correspondence_date,
            $device->primary_image,
            $device->status,
            $device->is_active == 1 ? 'فعال' : 'غیر فعال',
            $device->is_archive == 1 ? 'فعال' : 'غیر فعال',
            $device->dossier_id,
            $device->dossier ? $device->dossier->name : "",
            $device->category->title,
            verta($device->receive_date)->format('Y-n-j H:i'),
            verta($device->created_at)->format('Y-n-j H:i'),
            verta($device->updated_at)->format('Y-n-j H:i'),

            json_encode($value_arry_1, JSON_UNESCAPED_UNICODE)

        ];

        // foreach ($device->category->attributes as $key => $attribute) {
        // $DeviceAttribute=DeviceAttribute::where('attribute_id' ,$attribute->id)->where('device_id' ,$device->id )->get();
        // // array_push($head_arry, $attribute->name);
        // array_push($value_arry, $DeviceAttribute[0]->value);
        // };

        // foreach ($device->actions as $key => $action) {
        // array_push($value_arry,$action->description, $action->start_date , $action->end_date , User::find($action->user_id)->name);
        // // array_push($head_arry, "اقدام" . $key , "تاریخ شورع اقدام" , "تاریخ پایان اقدام" , "پرسنل ثبت کننده");

        // };

        return [
            $value_arry,
        ];
    }
}
