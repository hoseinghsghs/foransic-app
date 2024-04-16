<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Analytics;
use App\Models\Device;
use App\Models\User;
use App\Models\Action;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Spatie\Analytics\Period;

use Verta;

use function PHPUnit\Framework\isNull;

class DashboardController extends Controller
{

    public function index()
    {
        $v = verta();
        $year = $v->year;
        $m_1 = $v->month(1)->day(1)->toCarbon();
        $m_13 = $v->month(12)->day(30)->toCarbon();
        $now = Carbon::now();
        // try {
        //     if (Analytics::fetchVisitorsAndPageViews(Period::create($m_1, $m_13))->count()) {
        //         $lastyear = Analytics::fetchVisitorsAndPageViews(Period::create($m_1, $m_13));
        //     } else {
        //         $lastyear = [0];
        //     }


        //     $farvardin = $ordibehasht = $khordad = $tir = $mordad = $shahrivar = $mehr = $abaan = $azar = $dey = $bahman = $esfand = 0;
        //     foreach ($lastyear as $key => $value) {

        //         if (Verta::instance($value['date'])->month == 1) {
        //             $farvardin = $farvardin + 1;
        //         } elseif (Verta::instance($value['date'])->month == 2) {
        //             $ordibehasht = $ordibehasht + 1;
        //         } elseif (Verta::instance($value['date'])->month == 3) {
        //             $khordad = $khordad + 1;
        //         } elseif (Verta::instance($value['date'])->month == 4) {
        //             $tir = $tir + 1;
        //         } elseif (Verta::instance($value['date'])->month == 5) {
        //             $mordad = $mordad + 1;
        //         } elseif (Verta::instance($value['date'])->month == 6) {
        //             $shahrivar = $shahrivar + 1;
        //         } elseif (Verta::instance($value['date'])->month == 7) {
        //             $mehr = $mehr + 1;
        //         } elseif (Verta::instance($value['date'])->month == 8) {
        //             $abaan = $abaan + 1;
        //         } elseif (Verta::instance($value['date'])->month == 9) {
        //             $azar = $azar + 1;
        //         } elseif (Verta::instance($value['date'])->month == 10) {
        //             $dey = $dey + 1;
        //         } elseif (Verta::instance($value['date'])->month == 11) {
        //             $bahman = $bahman + 1;
        //         } elseif (Verta::instance($value['date'])->month == 12) {
        //             $esfand = $esfand + 1;
        //         }
        //     }
        //     $month_visits = [$farvardin, $ordibehasht, $khordad, $tir, $mordad, $shahrivar, $mehr, $abaan, $azar, $dey, $bahman, $esfand];
        // } catch (\Throwable $th) {
        //     $lastyear = [0];
        //     $month_visits = [0];
        // }


        $from = Carbon::now()->subDays(365);
        $to = Carbon::now();

        $all_devices =  Device::whereBetween('created_at', [$from, $to])->count();
        $all_actions =  Action::whereBetween('created_at', [$from, $to])->count();
        $status_device_1 = Device::whereBetween('created_at', [$from, $to])->where('status', 0)->count();
        $status_device_2 = Device::whereBetween('created_at', [$from, $to])->where('status', 1)->count();
        $status_device_3 = Device::whereBetween('created_at', [$from, $to])->where('status', 2)->count();
        $status_device_4 = Device::whereBetween('created_at', [$from, $to])->where('status', 3)->count();
        $users = User::role('personel')->get();
        //دستگاه ها ی برسسی نشده
        $status_device_checks = Device::whereBetween('created_at', [$from, $to])->where('status', 0)->get();

        $actions = Action::whereBetween('created_at', [$from, $to])->where('status', 1)->latest()->take(3)->get();

        // $all_order = Order::whereBetween('created_at', [$from, $to])->count();

        // // بر اساس زمان
        $month = 12;
        $successDevice = Device::getData($month, 0);
        // dd( $successDevice);
        $successDeviceChart = $this->chart($successDevice, $month);

        array_unshift($successDeviceChart, "data1");
        $lable = $this->chart($successDevice, $month);
        // dd ($successDevice,$month);
        // $unsuccessDevice = Device::getData($month, 0);
        // $unsuccessDeviceChart = $this->chart($unsuccessDevice, $month);
        // array_unshift($unsuccessDeviceChart, "data2");
        //پربازدید ترین صفحات
        // dd(array_values($successDeviceChart));
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
                // 'amunt_delivery_orders',
                // 'successsend_order',
                // 'returned_order',

            ),

            [
                'successDevice' => array_values($successDeviceChart),
                // 'unsuccessDevice' => array_values($unsuccessDeviceChart),
                'labels' => array_keys($lable),
            //     'transactionsCount' => [$successDevice->count(), $unsuccessDevice->count()]
            ]

        );
    }



    public function chart($devices, $month)
    {
        $result =  [
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
