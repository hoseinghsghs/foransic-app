<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Order::query();
    }
    public function headings(): array
    {
        return [
            'id',
            'user_id',
            'address_id ',
            'coupon_id',
            'status',
            'کل هزینه ',
            'هزینه ارسال',
            'مبلغ تخفیف کد تخفیف',
            'مبلغ قابل پرداخت',
            'نوع پرداخت',
            'روش ارسال',
            'وضعیت پرداخت',
            'توضیحات',
            'متن خطا',
            'تاریخ ساخت',
            'تاریخ بروزرسانی',
        ];
    }
}
