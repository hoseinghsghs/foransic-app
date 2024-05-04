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
                                        <div class="list-group-item list-group-item-primary" style="text-align: center">
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
                                        <div class="list-group-item list-group-item-primary mt-3">
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
                                <div class="list-group-item list-group-item-primary" style="text-align: center">
                                    خلاصه پرونده </div>
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
                                <div class="list-group-item list-group-item-primary" style="text-align: center">
                                    درخواست کارشناس پرونده از آزمایشگاه</div>
                                <div class="list-group-item list-group-item-action">
                                    <div class="row clearfix">
                                        <div class="col-12">{!! $dossier->expert !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="body">
                        <div class="header p-0 mt-4">
                            <strong style="color:#e47297">تصویر حکم قضایی</strong>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="card">
                                    <div class="blogitem mb-5">
                                        <div class="blogitem-image">
                                            <a href="{{ asset('storage/Judicial-image/' . $dossier->Judicial_image) }}"
                                                target="_blank"><img alt="تصویر حکم قضایی"
                                                    src={{ asset('storage/Judicial-image/' . $dossier->Judicial_image) }}>
                                            </a>
                                            <span class="blogitem-date">{{ verta($dossier->created_at) }} <span
                                                    class="text-success">اصلی</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
