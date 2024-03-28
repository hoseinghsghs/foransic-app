<?php

namespace App\Exports;

use App\Models\UserAddress;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserAddressExport implements FromQuery, WithHeadings

{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return UserAddress::query();
    }
    public function headings(): array
    {
        return [
            'id',
            'نام',
            'واحد',
            'تلفن-2',
            'آدرس-2',
            'عنوان',
            'آدرس',
            'کد پستی',
            'user_id ',
            'province_id',
            'city_id',
            'تلفن',
            'longitude',
            'latitude',
            'تاریخ ایجاد',
            'تاریخ بروزرسانی',

        ];
    }
}
