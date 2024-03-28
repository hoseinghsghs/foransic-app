<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromQuery, WithHeadings

{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return User::query();
    }
    public function headings(): array
    {
        return [
            'id',
            'نام',
            'تلفن',
            'آواتار',
            'وضعیت',
            'ایمیل',
            'تاریخ درستی سنجی ایمیل',
            'پسورد',
            'two_factor_secret',
            'two_factor_recovery_codes',
            'provider_name',
            'remember_token',
            'تاریخ ایجاد',
            'تاریخ بروزرسانی',

        ];
    }
}
