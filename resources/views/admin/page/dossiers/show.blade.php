@extends('admin.layout.MasterAdmin')
@section('title', 'مشاهده پرونده')
@section('Content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>نمایش پرونده</h2>
                        <br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item"><a href={{ route('admin.dossiers.index') }}>لیست پرونده</a>
                            </li>
                            <li class="breadcrumb-item active">نمایش پرونده</li>
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
                                <div class="list-group-item list-group-item-primary" style="text-align: center">
                                    مشخصات اصلی پرونده
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نام پرونده:</strong></div>
                                        <div class="col-6">{{ $dossier->name }}</div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>موضوع:</strong></div>
                                        <div class="col-6">{{ $dossier->subject }}</div>
                                    </div>
                                </div>
                                @hasanyrole(['Super Admin','company'])
                                    <div class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>آزمایشگاه:</strong></div>
                                            <div
                                                class="col-6">{{$dossier->laboratory()->exists()? $dossier->laboratory->name :'-'}}</div>
                                        </div>
                                    </div>
                                @endhasanyrole
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>نوع پرونده:</strong></div>
                                        <div class="col-6">{{ $dossier->dossier_type ? 'عملیاتی' : 'فاوایی' }}</div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>مدیریت یا معاونت:</strong></div>
                                        <div class="col-6">{{ $dossier->section }}</div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>رده:</strong></div>
                                        <div class="col-6">{{ $dossier->company->cellphone }}
                                            - {{ $dossier->company->name }}</div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>وضعیت:</strong></div>
                                        @if ($dossier->is_active)
                                            <spam class=" badge badge-success badge-pill">فعال</spam>
                                        @else
                                            <spam class=" badge badge-danger badge-pill">غیر فعال</spam>
                                        @endif
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-6"><strong>وضعیت بایگانی:</strong></div>
                                        @if ($dossier->is_archive)
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
                                <div class="card">
                                    <div class=" list-group">
                                        <div class="list-group-item list-group-item-primary text-center">
                                            اطلاعات کارشناس پرونده
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>کارشناس پرونده:</strong></div>
                                                <div class="col-6">{{ $dossier->dossier_case }}</div>
                                            </div>
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>تلفن کارشناس پرونده:</strong></div>
                                                <div class="col-6">{{ $dossier->expert_phone }}</div>
                                            </div>
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>شماره داخلی کارشناس پرونده:</strong></div>
                                                <div class="col-6">{{ $dossier->expert_cellphone }}</div>
                                            </div>
                                        </div>
                                        <div class="list-group-item list-group-item-primary text-center">
                                            اطلاعات قضایی
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>شماره حکم قضایی:</strong>
                                                </div>
                                                <div class="col-6">{{ $dossier->Judicial_number }}</div>
                                            </div>
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="row clearfix">
                                                <div class="col-6"><strong>تاریخ حکم قضایی:</strong>
                                                </div>
                                                <div class="col-6">{{ $dossier->Judicial_date }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class=" list-group">
                                <div class="list-group-item list-group-item-primary text-center">
                                    خلاصه پرونده
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-12">{!! $dossier->summary_description !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class=" list-group">
                                <div class="list-group-item list-group-item-primary text-center">
                                    درخواست کارشناس پرونده از آزمایشگاه
                                </div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-12">{!! $dossier->expert !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="header p-0 mt-4">
                    <strong style="color:#e47297">تصویر حکم قضایی</strong>
                </div>
                <hr>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12">
                        @isset($dossier->Judicial_image)
                            <div class="card">
                                <div class="blogitem mb-5">
                                    <div class="blogitem-image">
                                        <a href="{{ asset('storage/Judicial-image/' . $dossier->Judicial_image) }}"
                                           target="_blank"><img alt="تصویر حکم قضایی"
                                                                src={{ asset('storage/Judicial-image/' . $dossier->Judicial_image) }}>
                                        </a>
                                        <span class="blogitem-date">{{ verta($dossier->created_at) }}</span>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="card">
                                <span>ندارد</span>
                            </div>
                        @endisset
                    </div>
                </div>
                <div class="header p-0 mt-4">
                    <strong style="color:#e47297">لیست شواهد پرونده</strong>
                </div>
                <hr>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <div class="loader" wire:loading.flex>
                                    درحال بارگذاری ...
                                </div>
                                @if(count($devices)>0)
                                    <div class="table-responsive">
                                        <table class="table table-hover c_table theme-color">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>عنوان</th>
                                                <th>کد</th>
                                                @hasanyrole(['Super Admin','company'])
                                                    <th>آزمایشگاه</th>
                                                @endhasanyrole
                                                <th>شخص تحویل دهنده</th>
                                                <th>پرسنل تحویل گیرنده</th>
                                                <th>شخص تحویل گیرنده</th>
                                                <th>پرسنل تحویل دهنده</th>
                                                <th> تاریخ دریافت</th>
                                                <th> تاریخ تحویل</th>
                                                <th>وضعیت</th>
                                                <th>بایگانی</th>
                                                <th class="text-center">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($devices as $key => $device)
                                                <tr wire:key="name_{{ $device->id }}">
                                                    <td scope="row">{{ $devices->firstItem() + $key }}</td>
                                                    <td>
                                                        {{ $device->category->title }}
                                                    </td>
                                                    <td>
                                                        {{ $device->code }}
                                                    </td>
                                                    @hasanyrole(['Super Admin','company'])
                                                        <td>{{$device->laboratory()->exists()? $device->laboratory->name :'-'}}</td>
                                                    @endhasanyrole
                                                    <td>
                                                        {{ $device->delivery_name }}
                                                    </td>
                                                    <td>
                                                        @if ($device->receiver_staff_id)
                                                            {{ App\Models\User::find($device->receiver_staff_id)->name }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $device->receiver_name }}
                                                    </td>

                                                    <td>
                                                        @if ($device->delivery_staff_id)
                                                            {{ App\Models\User::find($device->delivery_staff_id)->name }}
                                                        @endif
                                                    </td>
                                                    <td dir="ltr">
                                                        {{ $device->receive_date }}
                                                    </td>
                                                    <td dir="ltr">
                                                        {{ $device->delivery_date }}
                                                    </td>
                                                    <td>
                                                        <span @class([
                                                    'badge','p-2',
                                                    'badge-success' => $device->is_active,
                                                    'badge-danger' => !$device->is_active,
                                                ])>
                                                            {{ $device->is_active ? 'فعال' : 'غیرفعال' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span  @class(['badge','p-2','badge-success' => !$device->is_archive,'badge-danger' => $device->is_archive])>{{ $device->is_archive ? 'بایگانی' : 'غیر بایگانی' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        {{-- <a onclick="loadbtn(event)"
                                                            href="{{ route('admin.devices.edit', $device->id) }}"
                                                            class="btn btn-raised btn-warning waves-effect">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </a> --}}
                                                        @can('actions-create')
                                                            <a onclick="loadbtn(event)" title="اضافه کردن اقدام"
                                                               data-toggle="tooltip"
                                                               data-placement="top"
                                                               href="{{ route('admin.actions.create', ['device' => $device->id]) }}"
                                                               class="btn btn-raised btn-info waves-effect">
                                                                ایجاد اقدام
                                                            </a>
                                                        @endcan
                                                        @canany(['devices-edit','device-image-edit','devices-show','device-print'])
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                        class="btn btn-md btn-warning btn-outline-primary dropdown-toggle"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    <i class="zmdi zmdi-menu"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    @can('devices-edit')
                                                                        <a href="{{ route('admin.devices.edit', ['device' => $device->id]) }}"
                                                                           class="dropdown-item text-right"> ویرایش </a>
                                                                    @endcan
                                                                    @can('device-image-edit')
                                                                        <a href="{{ route('admin.devices.images.edit', ['device' => $device->id]) }}"
                                                                           class="dropdown-item text-right"> ویرایش
                                                                            تصویر </a>
                                                                    @endcan
                                                                    @can('devices-show')
                                                                        <a href="{{ route('admin.devices.show', $device->id) }}"
                                                                           class="dropdown-item text-right"> مشاهده </a>
                                                                    @endcan
                                                                    @can('device-print')
                                                                        <a href="{{ route('admin.print.device.show', $device->id) }}"
                                                                           class="dropdown-item text-right"
                                                                           target="_blank">
                                                                            پرینت
                                                                            رسید
                                                                        </a>
                                                                    @endcan
                                                                </div>
                                                            </div>
                                                        @endcanany
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p>هیچ رکوردی وجود ندارد</p>
                                @endif
                            </div>
                        </div>
                        {{ $devices->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
