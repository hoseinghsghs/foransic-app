<?php

namespace App\Exports;

use App\Models\Crack;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CracksExport implements FromQuery, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $crack;
    public $lab;

    public function __construct()
    {
        $this->crack = Crack::all();
    }

    public function query()
    {
        return Crack::query();
    }
    public function headings(): array
    {
        return
            [
                'id',
                'عنوان',
                'ورژن برنامه',
                'فایل لایسنس',
                'is_seen',
                'کد سخت افزاری',
                'یوزر',
                'آیدی یوزر',
                'آزمایشگاه',
                'آیدی آزمایشگاه',
                'توضیحات پرسنل',
                'توضیحات ادمین',
                'تاریخ ایجاد',
                'آخرین تاریخ بروز رسانی'
            ];
    }

    public function map($crack): array
    {
        if (isset($crack->laboratory->name)) {
            $lab = $crack->laboratory->name;
        } else {
            $lab = "آزمایشگاه ندارد";
        }

        return [
            $crack->id,
            $crack->title,
            $crack->program_version,
            $crack->license_file,
            $crack->is_seen,
            $crack->hardware_code,
            $crack->user->name,
            $crack->user_id,
            $lab,
            $crack->laboratory_id,
            $crack->description_personal,
            $crack->description_admin,
            verta($crack->created_at)->format('Y-n-j H:i'),
            verta($crack->updated_at)->format('Y-n-j H:i'),
        ];
    }
}
