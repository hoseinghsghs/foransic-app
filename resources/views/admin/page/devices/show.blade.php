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
                <div class="header p-0">
                    <strong style="color:#e47297">مشخصات اصلی شواهد دیجیتال </strong>
                </div>
                <hr>
                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class=" list-group">
                                <div class="list-group-item list-group-item-primary">
                                    مشخصات اصلی شواهد دیجیتال
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نام شواهد دیجیتال :</strong></div>
                                        <div class="col-6">{{ $device->category->title }}</div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>سریال یا شماره اموال شواهد دیجیتال:</strong></div>
                                        <div class="col-6">{{ $device->code }}</div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
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
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>پرونده:</strong></div>
                                        <div class="col-6">
                                            @isset($device->dossier)
                                                {{$device->dossier->name }}
                                            @else
                                                ندارد
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                                @isset($device->dossier)
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>رده:</strong></div>
                                        <div class="col-6">
                                                {{ \App\Models\User::find($device->dossier->user_category_id)->cellphone }}
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>شماره پرونده :</strong></div>
                                        <div class="col-6">{{ $device->dossier->number_dossier }}</div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>عنوان پرونده :</strong></div>
                                        <div class="col-6">{{ $device->dossier->name }}</div>
                                    </div>
                                </div>
                                @endisset
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>وضعیت:</strong></div>
                                        @if ($device->is_active)
                                            <spam class=" badge badge-success badge-pill">فعال</spam>
                                        @else
                                            <spam class=" badge badge-danger badge-pill">غیر فعال</spam>
                                        @endif
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>وضعیت بایگانی:</strong></div>
                                        @if ($device->is_archive)
                                            <spam class=" badge badge-danger badge-pill">بایگانی</spam>
                                        @else
                                            <spam class=" badge badge-success badge-pill">انتشار</spam>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card card-body p-0">
                                    <div class=" list-group">
                                        <div class="list-group-item list-group-item-primary">
                                            دریافت و تحویل
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>تاریخ دریافت:</strong></div>
                                                <div class="col-6">{{ $device->receive_date }}</div>
                                            </div>
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>تاریخ تحویل:</strong></div>
                                                <div class="col-6">{{ $device->delivery_date }}</div>
                                            </div>
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>نام تحویل دهنده:</strong></div>
                                                <div class="col-6">{{ $device->delivery_name }}</div>
                                            </div>
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>کد پرسنلی تحویل دهنده:</strong></div>
                                                <div class="col-6">{{ $device->delivery_code }}</div>
                                            </div>
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>نام تحویل گیرنده:</strong></div>
                                                <div class="col-6">{{ $device->receiver_name }}</div>
                                            </div>
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>کد پرسنلی تحویل گیرنده:</strong></div>
                                                <div class="col-6">{{ $device->receiver_code }}</div>
                                            </div>
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>لوازم جانبی :</strong></div>
                                                <div class="col-6">{{ $device->accessories }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($device->attributes()->exists())
                    <div class="col-lg-6">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card card-body p-0">
                                    <div class=" list-group">
                                        <div class="list-group-item list-group-item-primary">
                                            ویژگی های دیوایس
                                        </div>
                                        @foreach($device->attributes as $device_attribute)
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>{{$device_attribute->attribute->name}}:</strong></div>
                                                <div class="col-6">{{ $device_attribute->value}}</div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-12">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card card-body p-0">
                                    <div class=" list-group">
                                        <div class="list-group-item list-group-item-primary">
                                            مشخصات (ظرفیت ، مدل و...)
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6">{!! $device->trait !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card card-body p-0">
                                    <div class=" list-group">
                                        <div class="list-group-item list-group-item-primary">
                                            توضیحات و اظهارات درخواست کننده :
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6">{!! $device->description !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="header p-0">
                    <strong style="color:#e47297">مشخصات مکاتبه </strong>
                </div>
                <hr>
                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="card card-body p-0">
                            <div class=" list-group">
                                <div class="list-group-item list-group-item-primary">
                                    شماره خودکار ساز نامه درخواست
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-12">{!! $device->correspondence_number !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-body p-0">
                            <div class=" list-group">
                                <div class="list-group-item list-group-item-primary">
                                    تاریخ مکاتبه
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-12">{!! $device->correspondence_date !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="header p-0">
                    <strong style="color:#e47297">تصویر مکاتبه </strong>
                </div>
                <hr>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            @isset($device->primary_image)
                                <div class="blogitem mb-5">
                                    <div class="blogitem-image">
                                        <a href="{{ url(env('DEVICE_PRIMARY_IMAGES_UPLOAD_PATCH') . $device->primary_image) }}"
                                           target="_blank"><img
                                                src={{ url(env('DEVICE_PRIMARY_IMAGES_UPLOAD_PATCH') . $device->primary_image) }}
                                                        alt="{{ $device->category->title }}"></a>
                                        <span class="blogitem-date">{{ verta($device->created_at) }}</span>
                                    </div>
                                </div>
                            @else
                                <span>ندارد</span>
                            @endisset
                        </div>
                    </div>
                </div>

                <div class="body" style="width: 100%">
                    <div class="header p-0">
                        <strong style="color:#e47297">تصاویر شواهد دیجیتال </strong>
                    </div>
                    <hr>
                    <div class="row clearfix">
                        @forelse($images as $item)
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
                        @empty
                            <div class="card">
                                <div class="col-12">ندارد</div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="header p-0">
                    <strong style="color:#e47297">اقدامات</strong>
                </div>
                <hr>
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
                                                <span dir="ltr" style=" font-size: 1rem">{{ $v2 }}</span> --
                                                <span class="mt-2">
                                                                <i class="zmdi zmdi-time"></i><span
                                                        style=" font-size: 1rem"> {{ $v4 }} پیش</span>
                                                        </span>
                                            </div>
                                            <span style="float: right">
                                                            <td class="text-center js-sweetalert" style="float: left">
                                                                @if ($action->is_print)
                                                                    <button
                                                                        class="btn btn-success">فعال در گزارش</button>
                                                                @else
                                                                    <button
                                                                        class="btn btn-danger">غیر فعال در گزارش</button>
                                                                @endif
                                                                <button class="btn btn-default">تاریخ و زمان شروع:
                                                                    <span
                                                                        dir="ltr">{{ $action->start_date }}</span></button>
                                                                <button class="btn btn-default">تاریخ و زمان پایان:
                                                                    <span
                                                                        dir="ltr">{{ $action->end_date }}</span></button>
                                                           </td>
                                                    </span>
                                            <h5 class="mt-5"><a href="#">توسط {{ $action->user->name }}</a></h5>
                                            <div>
                                                {{ $action->description }}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            <!-- پایان لیست -->
        </div>
    </section>

@endsection
