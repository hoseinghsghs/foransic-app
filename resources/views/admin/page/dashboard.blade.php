@extends('admin.layout.MasterAdmin')
@section('title', 'داشبورد')
@section('Content')
    <section class="content">
        <div class="">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>داشبورد</h2>
                        </br>
                        <ul class="breadcrumb">
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                class="zmdi zmdi-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon domains">
                            <div class="body">
                                <h6>دستگاه / قطعه های بررسی نشده</h6>
                                <h2>{{ $status_device_1 }}<small class="info"> از {{ $all_devices }} </small></h2>
                                <small> {{ (int) (($status_device_1 / ($all_devices > 0 ? $all_devices : 1)) * 100) }}%
                                    دستگاه / قطعه های بررسی نشده</small>
                                <div class="progress">
                                    <div class="progress-bar l-blue" role="progressbar" aria-valuenow="45" aria-valuemin="0"
                                        aria-valuemax="{{ $all_devices }}"
                                        style="width: {{ ($status_device_1 / ($all_devices > 0 ? $all_devices : 1)) * 100 }}%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon domains">
                            <div class="body">
                                <h6>دستگاه / قطعه های در حال بررسی</h6>
                                <h2>{{ $status_device_2 }} <small class="info">از {{ $all_devices }}</small></h2>
                                <small>{{ (int) (($status_device_2 / ($all_devices > 0 ? $all_devices : 1)) * 100) }}%
                                    دستگاه / قطعه های در حال بررسی</small>
                                <div class="progress">
                                    <div class="progress-bar l-green" role="progressbar" aria-valuenow="38"
                                        aria-valuemin="0" aria-valuemax="{{ $all_devices }}"
                                        style="width: {{ ($status_device_2 / ($all_devices > 0 ? $all_devices : 1)) * 100 }}%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon domains">
                            <div class="body">
                                <h6>تکمیل بررسی دستگاه / قطعه</h6>
                                <h2>{{ $status_device_3 }} <small class="info">از {{ $all_devices }}</small></h2>
                                <small> {{ (int) (($status_device_3 / ($all_devices > 0 ? $all_devices : 1)) * 100) }}%
                                    تکمیل بررسی دستگاه / قطعه
                                </small>
                                <div class="progress">
                                    <div class="progress-bar l-amber" role="progressbar" aria-valuenow="39"
                                        aria-valuemin="{{ $all_devices }}" aria-valuemax="100"
                                        style="width: {{ ($status_device_3 / ($all_devices > 0 ? $all_devices : 1)) * 100 }}%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon domains">
                            <div class="body">
                                <h6>دستگاه / قطعه های تحویل داده شده</h6>
                                <h2>{{ $status_device_4 }} <small class="info">از {{ $all_devices }}</small></h2>
                                <small>{{ (int) (($status_device_4 / ($all_devices > 0 ? $all_devices : 1)) * 100) }}%
                                    دستگاه / قطعه های تحویل داده شده
                                </small>
                                <div class="progress">
                                    <div class="progress-bar l-purple" role="progressbar" aria-valuenow="89"
                                        aria-valuemin="0" aria-valuemax="{{ $all_devices }}"
                                        style="width: {{ ($status_device_4 / ($all_devices > 0 ? $all_devices : 1)) * 100 }}%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($users->count())
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <h2>پرسنل آزمایشگاه</h2>
                                    <ul class="header-dropdown">
                                        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle"
                                                data-toggle="dropdown" role="button" aria-haspopup="true"
                                                aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>

                                        </li>
                                        <li class="remove">
                                            <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="table-responsive social_media_table">
                                    <table class="table table-hover c_table">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>نام</th>
                                                <th>شماره تماس</th>
                                                <th>وضعیت</th>
                                                <th>نقش</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td><span class="social_icon linkedin">{{ $user->id }}</span>
                                                    </td>
                                                    <td><span class="list-name">{{ $user->name }}</span>
                                                        <span class="text-muted"></span>
                                                    </td>
                                                    <td>{{ $user->cellphone }}</td>
                                                    <td>{{ $user->status }}</td>
                                                    <td>
                                                        @if ($user->getRoleNames()[0] == 'personel')
                                                            پرسنل آزمایشگاه
                                                        @else
                                                            {{ $user->getRoleNames() }}
                                                        @endif

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- <div class="row clearfix">
                <div class="col-lg-12">
                    <cart>
                        <div class="header">
                            <h6><strong><i class="zmdi zmdi-chart"></i> گزارش</strong> هزینه ها</h6>
                            <ul class="header-dropdown">
                            </ul>
                        </div>
                    </cart>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon ">
                        <div class="body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6>{{number_format( $amunt_success_orders)}} تومان</h6>
                                    <h6><i class="zmdi zmdi-print"></i> مجموع <strong>خالص پرداختی
                                            مشتری</strong></h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon">
                        <div class="body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6>{{number_format($amunt_coupon_orders)}} تومان</h6>
                                    <h6><i class="zmdi zmdi-turning-sign"></i> مجوع تخفیف ها</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon">
                        <div class="body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6>{{number_format($amunt_delivery_orders)}} تومان</h6>
                                    <h6><i class="zmdi zmdi-alert-circle-o"></i> هزینه های ارسال</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon">
                        <div class="body">
                            <div class="state_w1 mb-1 mt-1">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6>{{number_format($amunt_total_orders)}} تومان</h6>
                                        <h6><i class="zmdi zmdi-balance"></i> مجموع هزینه ها</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12 col-lg-12">

                    <div class="card">
                        <div class="header">
                            <h2><strong><i class="zmdi zmdi-chart"></i> گزارش </strong> تراکنش های یکسال گذشته </h2>
                        </div>
                        <div class="body">
                            <div id="chart-area-spline-transaction" class="c3_chart d_sales"></div>
                        </div>
                    </div>

                </div>

            </div>
             --}}
            </div>
        </div>
    </section>
    @push('scripts')
        <!-- نمودار درصد ترافیک -->
        {{-- <script>
initC3Chart();
function initC3Chart() {
    setTimeout(function() {
        $success = @json($successTransactions);
        $unsuccess = @json($unsuccessTransactions);
        $(document).ready(function() {
            var chart = c3.generate({
                bindto: "#chart-area-spline-transaction", // id of chart wrapper
                data: {
                    columns: [
                        // each columns data
                        [$success[0], $success[1], $success[2],
                            $success[3],
                            $success[4],
                            $success[5], $success[6], $success[7], $success[8], $success[9],
                            $success[10], $success[11], $success[12]
                        ],
                        [$unsuccess[0], $unsuccess[1], $unsuccess[2], $unsuccess[3],
                            $unsuccess[4], $unsuccess[5], $unsuccess[6], $unsuccess[7],
                            $unsuccess[8], $unsuccess[9], $unsuccess[10], $unsuccess[11],
                            $unsuccess[12]
                        ],
                    ],
                    type: "area-spline", // default type of chart
                    groups: [
                        ["data1", "data2"]
                    ],
                    colors: {
                        data1: Aero.colors["teal"],
                        data2: Aero.colors["red"],
                    },
                    names: {
                        // name of each serie
                        data1: "تراکنش موفق",
                        data2: "تراکنش ناموفق",
                    },
                },
                axis: {
                    x: {
                        type: "category",
                        // name of each category
                        categories: @json($labels),
                    },
                    y: {
                        show: false,
                        tick: {
                            format: function(d) {
                                return number_format(d) + ' ' + 'تومان';
                            },
                        }
                    }
                },
                legend: {
                    show: true, //hide legend
                },
                padding: {
                    bottom: 0,
                    top: 0,
                },
            });
        });
    }, 500);
}
</script> --}}
    @endpush
@endsection
