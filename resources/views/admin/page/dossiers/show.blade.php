@extends('admin.layout.MasterAdmin')
@section('title', 'مشاهده شواهد دیجیتال')
@section('Content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>نمایش شواهد دیجیتال</h2>
                        <br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);"><a
                                        href={{ route('admin.devices.index') }}>لیست شواهد دیجیتال</a></li>
                            <li class="breadcrumb-item active">نمایش شواهد دیجیتال</li>
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
                    <div class="col-lg-6">
                        <div class="card">
                            <div class=" list-group">
                                <button type="button" class="list-group-item list-group-item-primary">
                                    مشخصات اصلی شواهد دیجیتال
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نام شواهد دیجیتال:</strong></div>
                                        <div class="col-6">{{ $device->titleManagement->title }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>وضعیت بررسی:</strong></div>
                                        <div class="col-6">
                                            @switch($device->status)
                                                @case('0')
                                                    پذیرش شواهد دیجیتال
                                                @break

                                                @case('1')
                                                    در حال بررسی
                                                @break

                                                @case('2')
                                                    تکمیل تجزیه و تحلیل
                                                @case('3')
                                                    تحویل شواهد دیجیتال
                                                @endswitch
                                            </div>
                                        </div>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>رده:</strong></div>
                                            <div class="col-6">
                                                {{ \App\Models\User::find($device->dossier->user_category_id)->cellphone }}
                                            </div>
                                        </div>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>وضعیت:</strong></div>
                                            @if ($device->is_active)
                                                <spam class=" badge badge-success badge-pill">فعال</spam>
                                            @else
                                                <spam class=" badge badge-danger badge-pill">غیر فعال</spam>
                                            @endif
                                        </div>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>وضعیت بایگانی:</strong></div>
                                            @if ($device->is_archive)
                                                <spam class=" badge badge-danger badge-pill">بایگانی</spam>
                                            @else
                                                <spam class=" badge badge-success badge-pill">انتشار</spam>
                                            @endif
                                        </div>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>تاریخ دریافت:</strong></div>
                                            <div class="col-6">{{ $device->receiver_date }}</div>
                                        </div>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>تاریخ تحویل:</strong></div>
                                            <div class="col-6">{{ $device->delivery_date }}</div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row clearfix">
                                <div class="col-lg-12">
                                    <div class="card card-body">
                                        <div class=" list-group">
                                            <button type="button" class="list-group-item list-group-item-primary">
                                                دریافت و تحویل
                                            </button>
                                            <button type="button" class="list-group-item list-group-item-action">
                                                <div class="row clearfix">
                                                    <div class="col-6"><strong>نام تحویل دهنده:</strong></div>
                                                    <div class="col-6">{{ $device->delivery_name }}</div>
                                                </div>
                                            </button>
                                            <button type="button" class="list-group-item list-group-item-action">
                                                <div class="row clearfix">
                                                    <div class="col-6"><strong>کد پرسنلی تحویل دهنده:</strong></div>
                                                    <div class="col-6">{{ $device->delivery_code }}</div>
                                                </div>
                                            </button>
                                            <button type="button" class="list-group-item list-group-item-action">
                                                <div class="row clearfix">
                                                    <div class="col-6"><strong>نام تحویل گیرنده:</strong></div>
                                                    <div class="col-6">{{ $device->receiver_name }}</div>
                                                </div>
                                            </button>
                                            <button type="button" class="list-group-item list-group-item-action">
                                                <div class="row clearfix">
                                                    <div class="col-6"><strong>کد پرسنلی تحویل گیرنده:</strong></div>
                                                    <div class="col-6">{{ $device->receiver_code }}</div>
                                                </div>
                                            </button>
                                            <button type="button" class="list-group-item list-group-item-action">
                                                <div class="row clearfix">
                                                    <div class="col-6"><strong>لوازم جانبی :</strong></div>
                                                    <div class="col-6">{{ $device->accessories }}</div>
                                                </div>
                                            </button>
                                            <button type="button" class="list-group-item list-group-item-action">
                                                <div class="row clearfix">
                                                    <div class="col-6"><strong>توضیحات و اظهارات درخواست کننده :</strong></div>
                                                    <div class="col-6">{!! $device->description !!}</div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="body">
                            <div class="header p-0">
                                <strong>تصاویر </strong>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-4 col-md-12">
                                    <div class="card">
                                        <div class="blogitem mb-5">
                                            <div class="blogitem-image">
                                                <a href="{{ url(env('DEVICE_PRIMARY_IMAGES_UPLOAD_PATCH') . $device->primary_image) }}"
                                                    target="_blank"><img
                                                        src={{ url(env('DEVICE_PRIMARY_IMAGES_UPLOAD_PATCH') . $device->primary_image) }}
                                                        alt="{{ $device->titleManagement->title }}"></a>
                                                <span class="blogitem-date">{{ verta($device->created_at) }} <span
                                                        class="text-success">اصلی</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach ($images as $item)
                                    <div class="col-lg-4 col-md-12">
                                        <div class="card">
                                            <div class="blogitem mb-5">
                                                <div class="blogitem-image">
                                                    <a href="{{ url(env('DEVICE_IMAGES_UPLOAD_PATCH') . $item->image) }}"
                                                        target="_blank"><img
                                                            src="{{ url(env('DEVICE_IMAGES_UPLOAD_PATCH') . $item->image) }}"
                                                            alt="blog image"></a>
                                                    <span class="blogitem-date">{{ verta($item->created_at) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    @if (count($actions) === 0)
                                        <p>هیچ رکوردی وجود ندارد</p>
                                    @else
                                        <ul class="cbp_tmtimeline">
                                            @foreach ($actions as $action)
                                                @php
                                                    $v2 = Hekmatinasser\Verta\Verta::instance($action->created_at);
                                                    $v3 = $v2->diffMinutes();
                                                    $v4 = $v3 . ' ' . 'دقیقه';
                                                    if ($v3 <= 0) {
                                                        $v4 = ' لحظاتی پیش ';
                                                    }
                                                    if ($v3 > 60) {
                                                        $v3 = $v2->diffHours();
                                                        $v4 = $v3 . ' ' . 'ساعت';
                                                        if ($v3 > 60) {
                                                            $v3 = $v2->diffDays();
                                                            $v4 = $v3 . ' ' . 'روز';
                                                        }
                                                    }

                                                @endphp
                                                <li wire:key="{{ $action->description }} {{ $action->id }}"
                                                    wire:loading.attr="disabled">
                                                    <div class="cbp_tmicon"><i class="zmdi zmdi-account"></i>
                                                    </div>
                                                    <div class="cbp_tmlabel empty">
                                                        <div class="cbp_tmtime" style="background-color: #f170ff ">
                                                            <span style=" font-size: 1rem">{{ $v2 }}</span> --
                                                            <span>
                                                                <span class="mt-2"><i class="zmdi zmdi-time"></i><span
                                                                        style=" font-size: 1rem"> {{ $v4 }} پیش
                                                                    </span></span>
                                                            </span>
                                                        </div>
                                                        <span style="float: right">
                                                            <td class="text-center js-sweetalert" style="float: left">
                                                                @if ($action->is_print)
                                                                    <button class="btn btn-success">فعال در گزارش</button>
                                                                @else
                                                                    <button class="btn btn-danger">غیر فعال در گزارش</button>
                                                                @endif
                                                                <button class="btn btn-default">تاریخ و زمان شروع:
                                                                    {{ $action->start_date }}</button>
                                                                <button class="btn btn-default">تاریخ و زمان پایان:
                                                                    {{ $action->end_date }}</button>

                                                        </span>
                                                        </td>
                                                        </span>
                                                        <h5 class="mt-5"><a href="#">توسط {{ $action->user->name }}
                                                            </a>
                                                        </h5>

                                                        <div>
                                                            {{ $action->description }}
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- پایان لیست -->
                    </div>
                </div>
            </div>
        </section>

    @endsection
