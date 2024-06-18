<?php

namespace App\Exports;

use App\Models\Action;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ActionsExport implements FromQuery, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $action;

    public function __construct()
    {
        $this->action = Action::all();
    }
    public function query()
    {
        return Action::query();
    }
    public function headings(): array
    {
        return [
            'id',
            'توضیحات',
            'تاریخ و زمان شروع',
            'تاریخ و زمان پایان',
            'وضعیت',
            'نمایش در پرینت',
            ' کاربر',
            'شاهد دیجیتال',
            ' عنوان',
            "تاریخ ایجاد",
            "آخرین تاریخ بروز رسانی"
        ];
    }
    public function map($action): array
    {
        return [
            $action->id,
            $action->description,
            $action->start_date,
            $action->end_date,
            $action->status == 1 ? 'فعال' : 'غیر فعال',
            $action->is_print == 1 ? 'فعال' : 'غیر فعال',
            $action->user->name,
            $action->device->category->title,
            $action->category->title,
            verta($action->created_at)->format('Y-n-j H:i'),
            verta($action->updated_at)->format('Y-n-j H:i'),
        ];
    }

}
