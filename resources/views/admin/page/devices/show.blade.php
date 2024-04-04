@extends('admin.layout.MasterAdmin')
@section('title', 'مشاهده دیوایس')
@section('Content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>نمایش دیوایس</h2>
                        <br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);"><a
                                        href={{ route('admin.devices.index') }}>لیست دیوایس ها</a></li>
                            <li class="breadcrumb-item active">نمایش دیوایس</li>
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
                                    مشخصات اصلی دیوایس
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نام دیوایس:</strong></div>
                                        <div class="col-6">{{ $device->name }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>وضعیت بررسی:</strong></div>
                                        <div class="col-6">
                                            @switch($device->status)
                                                @case('0')
                                                    دریافت دیوایس
                                                    @break
                                                @case('1')
                                                    در حال بررسی
                                                    @break
                                                @case('2')
                                                    تکمیل بررسی
                                                @case('3')
                                                    تحویل دیوایس
                                            @endswitch
                                        </div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>رده:</strong></div>
                                        <div
                                            class="col-6">{{ \App\Models\User::find($device->user_category_id)->cellphone }}</div>
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
                                        <div class="col-6">{{$device->receiver_date}}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>تاریخ تحویل:</strong></div>
                                        <div class="col-6">{{$device->delivery_date}}</div>
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
                                                <div class="col-6">{{$device->delivery_name }}</div>
                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>کد پرسنلی تحویل دهنده:</strong></div>
                                                <div class="col-6">{{ $device->delivery_code}}</div>
                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>نام تحویل گیرنده:</strong></div>
                                                <div class="col-6">{{$device->receiver_name }}</div>
                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>کد پرسنلی تحویل گیرنده:</strong></div>
                                                <div class="col-6">{{ $device->receiver_code}}</div>
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
                                                <div class="col-6"><strong>توضیحات:</strong></div>
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
                                                    alt="{{ $device->name }}"></a>
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
                </div>
            </div>
        </div>
    </section>
@endsection
