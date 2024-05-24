@extends('admin.layout.MasterAdmin')
@section('title', 'داشبورد')
@section('Content')

@hasanyrole(['Super Admin','viewer'])
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>داشبورد</h2>
                    </br>
                    <ul class="breadcrumb">
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon domains">
                        <div class="body">
                            <h6>شواهد دیجیتال بررسی نشده</h6>
                            <h2>{{ $status_device_1 }}<small class="info"> از {{ $all_devices }} </small></h2>
                            <small> {{ (int) (($status_device_1 / ($all_devices > 0 ? $all_devices : 1)) * 100) }}%
                                شواهد بررسی نشده</small>
                            <div class="progress">
                                <div class="progress-bar l-blue" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="{{ $all_devices }}" style="width: {{ ($status_device_1 / ($all_devices > 0 ? $all_devices : 1)) * 100 }}%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon domains">
                        <div class="body">
                            <h6>شواهد در حال بررسی</h6>
                            <h2>{{ $status_device_2 }} <small class="info">از {{ $all_devices }}</small></h2>
                            <small>{{ (int) (($status_device_2 / ($all_devices > 0 ? $all_devices : 1)) * 100) }}%
                                شواهد در حال بررسی</small>
                            <div class="progress">
                                <div class="progress-bar l-green" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="{{ $all_devices }}" style="width: {{ ($status_device_2 / ($all_devices > 0 ? $all_devices : 1)) * 100 }}%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon domains">
                        <div class="body">
                            <h6>تکمیل بررسی شواهد</h6>
                            <h2>{{ $status_device_3 }} <small class="info">از {{ $all_devices }}</small></h2>
                            <small> {{ (int) (($status_device_3 / ($all_devices > 0 ? $all_devices : 1)) * 100) }}%
                                تکمیل بررسی شواهد
                            </small>
                            <div class="progress">
                                <div class="progress-bar l-amber" role="progressbar" aria-valuenow="39" aria-valuemin="{{ $all_devices }}" aria-valuemax="100" style="width: {{ ($status_device_3 / ($all_devices > 0 ? $all_devices : 1)) * 100 }}%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card widget_2 big_icon domains">
                        <div class="body">
                            <h6>شواهد دیجیتال تحویل داده شده</h6>
                            <h2>{{ $status_device_4 }} <small class="info">از {{ $all_devices }}</small></h2>
                            <small>{{ (int) (($status_device_4 / ($all_devices > 0 ? $all_devices : 1)) * 100) }}%
                                شواهد دیجیتال تحویل داده شده
                            </small>
                            <div class="progress">
                                <div class="progress-bar l-purple" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="{{ $all_devices }}" style="width: {{ ($status_device_4 / ($all_devices > 0 ? $all_devices : 1)) * 100 }}%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- بررسی نشده --}}
            @if ($users->count())
            <div class="row clearfix">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2> شواهد دیجیتال بررسی نشده</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>

                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="table-responsive social_media_table">
                            <table class="table table-hover c_table">
                                <thead>
                                    <tr style="background-color: #ffa3bb">
                                        <th>id</th>
                                        <th>نام</th>
                                        <th>رده</th>
                                        <th>تاریخ پذیرش</th>
                                        <th>نام کیس یا پرونده</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($status_device_checks as $status_device_check)
                                    <tr>
                                        <td><span class="social_icon linkedin" style="background-color: #f54171">{{ $status_device_check->id }}</span>
                                        </td>
                                        <td><span class="list-name">{{ $status_device_check->category->title }}</span>
                                            <span class="text-muted"></span>
                                        </td>
                                        <td>
                                            @if ($status_device_check->dossier)
                                            {{ \App\Models\User::find($status_device_check->dossier->user_category_id)->name }}
                                            @endif
                                        </td>
                                        <td>{{ verta($status_device_check->created_at)->format('Y/n/j') }}</td>
                                        <td>
                                            @if ($status_device_check->dossier)
                                            {{ $status_device_check->dossier->name }}
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

            @if ($actions->count())
            <div class="row clearfix">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2>آخرین اقدامات </h2>
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>

                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="table-responsive social_media_table">
                            <table class="table table-hover c_table">
                                <thead>
                                    <tr style="background-color: #b2e0ff">
                                        <th>id</th>
                                        <th>توسط</th>
                                        <th>وضعیت</th>
                                        <th>تاریخ ایجاد</th>
                                        <th>توضیح اقدام</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($actions as $key => $action)
                                    @php
                                    $v2 = Hekmatinasser\Verta\Verta::instance($action->created_at);
                                    $v3 = $v2->diffMinutes();
                                    $v4 = $v3 . ' ' . 'دقیقه';
                                    if ($v3 <= 0) { $v4=' لحظاتی پیش ' ; } if ($v3> 60) {
                                        $v3 = $v2->diffHours();
                                        $v4 = $v3 . ' ' . 'ساعت';
                                        if ($v3 > 60) {
                                        $v3 = $v2->diffDays();
                                        $v4 = $v3 . ' ' . 'روز';
                                        }
                                        }

                                        @endphp
                                        <tr>
                                            <td><span class="social_icon linkedin">{{ $action->id }}</span>
                                            </td>
                                            <td><span class="list-name">
                                                    {{ $action->user->name }}
                                                </span>
                                                <span class="text-muted"></span>
                                            </td>
                                            <td>
                                                @if ($action->status)
                                                <span class="text-success">فعال</span>
                                                @else
                                                <span class="text-danger">فعال</span>
                                                @endif
                                            </td>
                                            <td>{{ $v4 }} پیش -- {{ $v2 }}</td>
                                            <td>
                                                <button type="button" class="btn bg-teal waves-effect" data-toggle="modal" data-target="#defaultModal-{{ $key }}"><i class="zmdi zmdi-eye"></i></button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="defaultModal-{{ $key }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">{{ $action->description }}</div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">بستن
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="row clearfix">
                <div class="col-md-12 col-lg-12">

                    <div class="card">
                        <div class="header">
                            <h2><strong><i class="zmdi zmdi-chart"></i> گزارش </strong> دیوایس های دریافتی یکسال گذشته
                            </h2>
                        </div>
                        <div class="body">
                            <div id="chart-area-spline-device" class="c3_chart d_sales"></div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>
@else
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>داشبورد</h2>
                    </br>
                    <ul class="breadcrumb">
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="body">
                        <img src="{{ url(env('GUIDE_IMAGES_PATCH') . $image->url) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endhasanyrole

@push('scripts')
<!-- نمودار درصد ترافیک -->
<script>
    initC3Chart();

    function initC3Chart() {
        setTimeout(function() {
            $success = @json($successDevice);
            $(document).ready(function() {
                var i;
                var chart = c3.generate({
                    bindto: "#chart-area-spline-device", // id of chart wrapper
                    data: {
                        columns: [
                            $.each($success, function(key, val) {
                                $success[key]
                            })
                        ],
                        axes: {
                            data2: 'y2'
                        },
                        type: "bar", // default type of chart
                        colors: {
                            data1: Aero.colors["teal"],
                        },
                        names: {
                            // name of each serie
                            data1: "دیوایس های دریافتی",
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
                                    return d + ' ' + 'عدد';
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
</script>
{{-- <script>
            $success = @json($successDevice);
            var chart = c3.generate({
                bindto: '#chart-area-spline-device',
                data: {
                    columns: [
                        [$success[0], $success[1], $success[2], $success[3], $success[4], $success[5], $success[6],
                            $success[7], $success[8], $success[9], $success[10], $success[11], $success[12]
                        ],
                        // ['data2', 50, 20, 10, 40, 15, 25]
                    ]
                }
            });
        </script> --}}
@endpush
@endsection