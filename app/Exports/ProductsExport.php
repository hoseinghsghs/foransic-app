<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\ProductVariation;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return ProductVariation::query();
    }
    public function headings(): array
    {
        return [
            'id',
            'arributeID',
            'productID',
            'مقدار',
            'قیمت',
            'قیمت پایه',
            'درصد افزایش',
            'تعداد',
            'شناسه انبار',
            'گارانتی',
            'زمان گارانتی',
            'قیمت تخفیف دار',
            'تاریخ شروع حراجی',
            'تاریخ پایان حراجی',
            'تاریخ ایجاد',
            'تاریخ بروزرسانی',
        ];
    }
}
