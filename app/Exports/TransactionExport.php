<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Transaction::query();
    }
    public function headings(): array
    {
        return [
            'id',
            'user_id',
            'order_id',
            'قیمت',
            'ref_id',
            'توکن',
            'ip',
            'توضیحات',
            'متن ارور',
            'نام درگاه',
            'وضعیت',
            'تاریخ ایجاد',
            'تاریخ بروزرسانی',

        ];
    }
}
