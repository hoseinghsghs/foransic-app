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
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
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
                                    <div class="col-6">{{$dossier->laboratory()->exists()? $dossier->laboratory->name :'-'}}</div>
                                </div>
                            </div>
                            @endhasanyrole
                            <div class="list-group-item list-group-item-action">
                                <div class="row clearfix">
                                    <div class="col-6"><strong>نوع پرونده:</strong></div>
                                    <div class="col-6">{{ $dossier->dossier_type ? 'فاوایی'  : 'عملیاتی'}}</div>
                                </div>
                            </div>
                            <div class="list-group-item list-group-item-action">
                                <div class="row clearfix">
                                    <div class="col-6"><strong>مدیریت یا معاونت:</strong></div>
                                    <div class="col-6">{{ $dossier->section->name }}</div>
                                </div>
                            </div>
                            <div class="list-group-item list-group-item-action">
                                <div class="row clearfix">
                                    <div class="col-6"><strong> حوزه اقدام :</strong></div>
                                    <div class="col-6">{{ $dossier->zone->title }}</div>
                                </div>
                            </div>
                            <div class="list-group-item list-group-item-action">
                                <div class="row clearfix">
                                    <div class="col-6"><strong>  کشور حوزه اقدام :</strong></div>
                                    <div class="col-6">{{$dossier->zone->country ? $dossier->zone->country :'-'}}</div>
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
                                    <spam class=" badge badge-success badge-pill">مفتوح</spam>
                                    @else
                                    <spam class="badge badge-dark badge-pill" style="background-color: #000000">مختومه</spam>
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
                                <a href="{{ asset('storage/Judicial-image/' . $dossier->Judicial_image) }}" target="_blank"><img alt="تصویر حکم قضایی" src={{ asset('storage/Judicial-image/' . $dossier->Judicial_image) }}>
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
                @can('devices-create')
                <a id="sub" href="{{ route('admin.devices.create') }}" style="float: left" class="btn btn-raised btn-info waves-effect mr-auto">
                    افزودن شواهد پرونده<i class="zmdi zmdi-plus mr-1"></i></a>
                @endcan
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
                                            <th>
                                            </th>
                                            <th>ردیف</th>
                                            <th>کد یکتا</th>
                                            <th>عنوان</th>
                                            <th>مدل</th>
                                            @hasanyrole(['Super Admin','company','viewer'])
                                            <th>آزمایشگاه</th>
                                            @endhasanyrole
                                            <th> تاریخ پذیرش</th>
                                            <th>پرونده</th>
                                            <th>وضعیت بررسی</th>
                                            <th>پرسنل تحویل گیرنده</th>
                                            <th>وضعیت</th>
                                            <th>بایگانی</th>
                                            <th class="text-center">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($devices as $key => $device)
                                        <tr wire:key="name_{{ $device->id }}">
                                            @canany(['devices-edit','device-image-edit','devices-show','device-print'])
                                            <td scope="row">
                                                @can('devices-edit')
                                                <a href="{{ route('admin.devices.edit', ['device' => $device->id]) }}" class="btn btn-warning btn-sm text-right"> <i class="zmdi zmdi-edit"></i></a>
                                                @endcan
                                                @can('devices-show')
                                                <a href="{{ route('admin.devices.show', $device->id) }}" class="btn btn-primary btn-sm  text-right"> <i class="zmdi zmdi-eye"></i></a>
                                                @endcan
                                                @if ($device->correspondence_number)
                                                <i class="zmdi zmdi-email btn btn-success btn-sm"></i>
                                                @else
                                                <i class="zmdi zmdi-hourglass-alt btn btn-sm"></i>
                                                @endif
                                            </td>
                                            @endcanany
                                            <td scope="row">{{ $devices->firstItem() + $key }}</td>
                                            <td>
                                                {{ $device->id }}
                                            </td>
                                            <td>
                                                {{ $device->category->title }}
                                            </td>
                                            <td>
                                                {{ $device->code }}
                                            </td>

                                            @hasanyrole(['Super Admin','company','viewer'])
                                            <td>{{$device->laboratory()->exists()? $device->laboratory->name :'-'}}</td>
                                            @endhasanyrole
                                            <td dir="ltr">
                                                {{ $device->receive_date }}
                                            </td>
                                            <td>
                                                {{ $device->dossier->name }}
                                            </td>


                                            <td>
                                                @switch($device->status)
                                                @case('0')
                                                <span class="badge badge-danger badge-pill" style="font-size: 0.75rem;padding-right: 14px;
                                            padding-left: 14px;
                                            padding-bottom: 7px;">
                                                    پذیرش شواهد دیجیتال
                                                </span>
                                                @break

                                                @case('1')
                                                <span class="badge badge-warning badge-pill" style="font-size: 0.75rem;padding-right: 14px;
                                            padding-left: 14px;
                                            padding-bottom: 7px;">
                                                    در حال بررسی
                                                </span>
                                                @break

                                                @case('2')
                                                <span class="badge badge-success badge-pill" style="font-size: 0.75rem;padding-right: 14px;
                                            padding-left: 14px;
                                            padding-bottom: 7px;">
                                                    تکمیل تجزیه و تحلیل
                                                </span>
                                                @break
                                                @case('3')
                                                <span class="badge badge-primary badge-pill" style="font-size: 0.75rem;padding-right: 14px;
    padding-left: 14px;
    padding-bottom: 7px;">
                                                    خروج شواهد دیجیتال
                                                </span>
                                                @endswitch
                                            </td>

                                            <td>
                                                @if ($device->receiver_staff_id)
                                                {{ App\Models\User::find($device->receiver_staff_id)->name }}
                                                @endif
                                            </td>
                                            <td>
                                                <button wire:click="ChangeActive_device({{ $device->id }})" wire:loading.attr="disabled" @class([ 'btn btn-raised waves-effect' , 'btn-success'=> $device->is_active,
                                                    'btn-danger' => !$device->is_active,
                                                    ])>
                                                    {{ $device->is_active ? 'فعال' : 'غیرفعال' }}
                                                </button>
                                            </td>
                                            <td>
                                                <button wire:click="ChangeArchive_device({{ $device->id }})" wire:loading.attr="disabled" class="btn btn-raised btn-danger waves-effect">بایگانی
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                {{-- <a onclick="loadbtn(event)"
                                                        href="{{ route('admin.devices.edit', $device->id) }}"
                                                class="btn btn-raised btn-warning waves-effect">
                                                <i class="zmdi zmdi-edit"></i>
                                                </a> --}}
                                                @can('actions-create')
                                                <a onclick="loadbtn(event)" title="اضافه کردن اقدام" data-toggle="tooltip" data-placement="top" href="{{ route('admin.actions.create', ['device' => $device->id]) }}" class="btn btn-raised btn-info waves-effect">
                                                    ایجاد اقدام
                                                </a>
                                                @endcan
                                                @canany(['devices-edit','device-image-edit','devices-show','device-print'])
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-md btn-warning btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="zmdi zmdi-menu"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @can('devices-edit')
                                                        <a href="{{ route('admin.devices.edit', ['device' => $device->id]) }}" class="dropdown-item text-right"> ویرایش </a>
                                                        @endcan
                                                        @can('device-image-edit')
                                                        <a href="{{ route('admin.devices.images.edit', ['device' => $device->id]) }}" class="dropdown-item text-right"> ویرایش
                                                            تصویر </a>
                                                        @endcan
                                                        @can('devices-show')
                                                        <a href="{{ route('admin.devices.show', $device->id) }}" class="dropdown-item text-right"> مشاهده </a>
                                                        @endcan
                                                        @can('device-print')
                                                        <a href="{{ route('admin.print.device.show', $device->id) }}" class="dropdown-item text-right" target="_blank">
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
@push('scripts')
<script>
    $('#sub').on('click', function() {
        "{{ session()->flash('dossier', $dossier->id) }}"
    });
</script>

@endpush
