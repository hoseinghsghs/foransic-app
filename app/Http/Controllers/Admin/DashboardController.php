<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Analytics;
use App\Models\Device;
use App\Models\User;
use App\Models\Action;
use App\Models\Guide;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Spatie\Analytics\Period;

use Verta;

use function PHPUnit\Framework\isNull;

class DashboardController extends Controller
{
    public function index()
    {
        $from = Carbon::now()->subDays(365);
        $to = Carbon::now();

        $all_actions = Action::whereBetween('created_at', [$from, $to])->count();
        $devices = Device::whereBetween('created_at', [$from, $to])->get();
        $all_devices = $devices->count();
        $status_device_1 = $devices->where('status', 0)->count();
        $status_device_2 = $devices->where('status', 1)->count();
        $status_device_3 = $devices->where('status', 2)->count();
        $status_device_4 = $devices->where('status', 3)->count();
        //دستگاه ها ی بررسی نشده
        $status_device_checks = $devices->where('status', 0)->sortBy('desc')->take(5);

        $users = User::role('personnel')->latest()->take(5)->get();

        $actions = Action::whereBetween('created_at', [$from, $to])->where('status', 1)->latest()->take(5)->get();
        $image = Guide::where('type', 'image')->where('category', 'banner')->latest()->first();

        // // بر اساس زمان
        $month = 12;
        $successDevice = Device::whereBetween('created_at', [$from, $to])->get();
        $deliveryDevice = Device::whereBetween('created_at', [$from, $to])->where('status', 3)->get();
        $receiveDevice = Device::whereBetween('created_at', [$from, $to])->where('status', 0)->get();
        // dd( $successDevice);
        $successDeviceChart = $this->chart($successDevice, $month);
        $deliveryDeviceChart = $this->chart($deliveryDevice, $month);
        $receiveDeviceChart = $this->chart($receiveDevice, $month);

        array_unshift($successDeviceChart, "data1");
        array_unshift($deliveryDeviceChart, "data2");
        array_unshift($receiveDeviceChart, "data3");
        $lable = $this->chart($successDevice, $month);
        // $lable2 = $this->chart($deliveryDeviceChart, $month);
        return view(
            'admin.page.dashboard'
            ,
            compact(
                'status_device_1',
                'status_device_2',
                'status_device_3',
                'status_device_4',
                'all_actions',
                'all_devices',
                'users',
                'status_device_checks',
                'actions',
                'image'
            ),

            [
                'successDevice' => array_values($successDeviceChart),
                'deliveryDevice' => array_values($deliveryDeviceChart),
                'receiveDevice' => array_values($receiveDeviceChart),
                'labels' => array_keys($lable),
                // 'labels2' => array_keys($lable2),
            ]

        );
    }


    public function chart($devices, $month)
    {
        $result = [
            "اسفند" => 0,
            "بهمن" => 0,
            "دی" => 0,
            "آذز" => 0,
            "آبان" => 0,
            "مهر" => 0,
            "شهریور" => 0,
            "مرداد" => 0,
            "تیر" => 0,
            "خرداد" => 0,
            "اردیبهشت" => 0,
            "فروردین" => 0,
        ];

        $monthName = $devices->map(function ($item) {
            return verta($item->created_at)->format('%B');
        });

        foreach ($monthName as $i => $v) {
            if (!isset($result[$v])) {
                $result[$v] = 0;
            }
            $result[$v] += 1;
        }


        return array_reverse($result);
    }
}
