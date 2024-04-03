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
                                        href={{ route('admin.devices.index') }}>لیست دیوایسات</a></li>
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
                                        <div class="col-6"><strong>رده:</strong></div>
                                        <div class="col-6">{{ $device->name }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>تاریخ ایجاد :</strong></div>
                                        <div class="col-6">{{ verta($device->created_at) }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong> آخرین تاریخ بروزرسانی :</strong></div>
                                        <div class="col-6">{{ verta($device->updated_at) }}</div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نام برند :</strong></div>
                                        <div class="col-6">
                                            @if ($device->brand)
                                                {{ $device->brand->name }}
                                            @endif
                                        </div>
                                    </div>
                                </button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نام دسته بندی :</strong></div>
                                        <div class="col-6">{{ $device->category->name }}</div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class=" list-group">
                                        <button type="button" class="list-group-item list-group-item-primary">
                                            هزینه حمل </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>هزینه ارسال:</strong></div>
                                                @if ($device->delivery_amount)
                                                    <div class="col-6">{{ number_format($device->delivery_amount) }} تومان
                                                    </div>
                                                @endif
                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>هزینه ارسال به ازای دیوایس:</strong></div>
                                                @if ($device->delivery_amount_per_device)
                                                    <div class="col-6">
                                                        {{ number_format($device->delivery_amount_per_device) }}
                                                        تومان</div>
                                                @endif
                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>محل قرار گیری :</strong></div>
                                                <div class="col-6">{{ $device->position }}</div>
                                            </div>
                                        </button>
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>slug:</strong></div>
                                                <div class="col-6">{{ $device->slug }}</div>
                                            </div>
                                        </button>

                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class=" list-group">
                                <button type="button" class="list-group-item list-group-item-primary">
                                    ویژگی ها </button>
                                @if (!$device_attributes->isEmpty())
                                    @foreach ($device_attributes as $device_attribute)
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6">
                                                    <strong>{{ $device_attribute->attribute->name }}:</strong>
                                                </div>
                                                <div class="col-6">{{ $device_attribute->value }}</div>
                                            </div>

                                        </button>
                                    @endforeach
                                @else
                                    <button type="button" class="list-group-item list-group-item-action">
                                        وجود ندارد
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card">
                            <div class=" list-group">
                                <button type="button" class="list-group-item list-group-item-primary">
                                    تگ ها </button>
                                @if (!$tags->isEmpty())
                                    @foreach ($tags as $tag)
                                        <button type="button" class="list-group-item list-group-item-action">
                                            <center>{{ $tag->name }}</center>
                                        </button>
                                    @endforeach
                                @else
                                    <button type="button" class="list-group-item list-group-item-action">
                                        وجود ندارد
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class=" list-group">
                                <button type="button" class="list-group-item list-group-item-primary">
                                    توضیحات</button>
                                <button type="button" class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-12">{!! $device->description !!}}</div>
                                    </div>
                                </button>

                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <div class="header p-0">
                            <strong>دسته بندی ها </strong>
                        </div>
                        <hr>
                        <div class="row clearfix mb-5 m-2">
                            @foreach ($device_variation as $variation)
                                <div class="col-md-12">
                                    <div class="d-flex">
                                        <p class="mb-0"> </p>
                                        <p class="mb-0 mr-3">
                                            <span>مشاهده قیمت و موجودی برای متغیر (
                                                {{ $variation->value }} ) </span>
                                            <a class="waves-effect btn btn-primary" type="button" data-toggle="collapse"
                                                data-target="#collapse-{{ $variation->id }}">

                                                <i class="zmdi zmdi-chevron-down" style="color: white;"> </i>

                                            </a>

                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="collapse mt-2" id="collapse-{{ $variation->id }}">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label> قیمت </label>
                                                    @if ($variation->price != null)
                                                        <input type="text" disabled class="form-control"
                                                            value="{{ number_format($variation->price) }} تومان">
                                                    @endif

                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label> تعداد </label>
                                                    <input type="text" disabled class="form-control"
                                                        value="{{ $variation->quantity }}">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label> sku </label>
                                                    <input type="text" disabled class="form-control"
                                                        value="{{ $variation->sku }}">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label> قیمت پایه </label>
                                                    <input type="text" disabled class="form-control"
                                                        value="{{ $variation->base_price }}">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label> درصد افزاریش </label>
                                                    <input type="text" disabled class="form-control"
                                                        value="{{ $variation->percent_price }}">
                                                </div>


                                                {{-- Sale Section --}}
                                                <div class="col-md-12">
                                                    <p> حراج : </p>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label> قیمت حراجی </label>
                                                    @if ($variation->sale_price)
                                                        <input type="text"
                                                            value="{{ number_format($variation->sale_price) }} تومان"
                                                            disabled class="form-control">
                                                    @else
                                                        <input type="text" disabled class="form-control">
                                                    @endif

                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label> تاریخ شروع حراجی </label>
                                                    <input type="text"
                                                        value="{{ $variation->date_on_sale_from == null ? null : verta($variation->date_on_sale_from) }}"
                                                        disabled class="form-control">
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label> تاریخ پایان حراجی </label>
                                                    <input type="text"
                                                        value="{{ $variation->date_on_sale_to == null ? null : verta($variation->date_on_sale_to) }}"
                                                        disabled class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

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
                                            <a href="{{ url(env('PRODUCT_PRIMARY_IMAGES_UPLOAD_PATCH') . $device->primary_image) }}"
                                                target="_blank"><img
                                                    src={{ url(env('PRODUCT_PRIMARY_IMAGES_UPLOAD_PATCH') . $device->primary_image) }}
                                                    alt="{{ $device->name }}"></a>
                                            <span class="blogitem-date">{{ verta($device->created_at) }} <span
                                                    class="text-success">اصلی</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card">
                                    <div class="blogitem mb-5">
                                        <div class="blogitem-image">
                                            <a href="{{ url(env('SMALL_PRODUCT_PRIMARY_IMAGES_UPLOAD_PATCH') . $device->small_primary_image) }}"
                                                target="_blank"><img
                                                    src={{ url(env('SMALL_PRODUCT_PRIMARY_IMAGES_UPLOAD_PATCH') . $device->small_primary_image) }}
                                                    alt="{{ $device->name }}"></a>
                                            <span class="blogitem-date">{{ verta($device->created_at) }} <span
                                                    class="text-success">تصویر کم حجم</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach ($images as $item)
                                <div class="col-lg-4 col-md-12">
                                    <div class="card">
                                        <div class="blogitem mb-5">
                                            <div class="blogitem-image">
                                                <a href="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATCH') . $item->image) }}"
                                                    target="_blank"><img
                                                        src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATCH') . $item->image) }}"
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



    </section>
@endsection
