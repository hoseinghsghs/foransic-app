<?php

namespace App\Exports;

use App\Models\Device;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DevicesExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Device::query();
    }
    public function headings(): array
    {
        return [
            'id',
            'نام محصول',
            'محل قرار گیری',
            'لیبل',
            'brand_id ',
            'category_id ',
            'slug',
            'عکس اصلی',
            'سایز کوچک عکس اصلی',
            'توضیحات',
            'وضعیت',
            'فعال یا غیر فعال',
            'آرشیو',
            'هزینه ارسال',
            'هزینه ارسال به ازای محصول اضافه',
            'تاریخ ساخت',
            'تاریخ بروزرسانی',
        ];
    }
}
