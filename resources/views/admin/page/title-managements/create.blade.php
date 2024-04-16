@extends('admin.layout.MasterAdmin')
@section('title', 'ایجاد عنوان')
@section('Content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>اضافه کردن عنوان</h2>
                        </br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);"> عناوین</a></li>
                            <li class="breadcrumb-item active">عنوان جدید</li>
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

                @livewire('admin.title-managements.title-management-controll', key($title_managements->id))
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            {{ $title_managements->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
