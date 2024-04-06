@extends('admin.layout.MasterAdmin')
@section('title','پروفایل کاربری')
@section('Content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>ویرایش پروفایل</h2>
                        </br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><i class="zmdi zmdi-home"></i>
                                    خانه</li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    @method('PUT')
                                    <div class="row clearfix">
                                        <div class="col-md-4">
                                            <label>نام و نام خانوادگی</label>
                                            <div class="form-group">
                                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{auth()->user()->name}}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>شماره تماس</label>
                                            <div class="form-group">
                                                <input name="cellphone" type="number" maxlength="11" class="form-control without-spin @error('cellphone') is-invalid @enderror" value="{{auth()->user()->cellphone}}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>ایمیل</label>
                                            <div class="form-group">
                                                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{auth()->user()->email}}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">عکس پروفایل</label>
                                            <div class="form-group ">
                                                <input type="file" class="dropify" name="avatar" id="dropifyt" data-default-file="{{auth()->user()->avatar ? asset('storage/profile/'.auth()->user()->avatar) : asset('img/profile.png') }}" data-max-file-size="1024K" data-allowed-file-extensions="jpg png jpeg" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button onclick="loadbtn(event)" type="submit" class="btn btn-raised btn-primary waves-effect">
                                            ذخیره
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="body">
                                <form id="form_advanced_validation" class="needs-validation" action="{{route('user-password.update')}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        @isset(auth()->user()->password)
                                            <div class="col-md-4">
                                                <label class="p-1">رمز عبور فعلی *</label>
                                                <div class="mb-3">
                                                    <input name="current_password" type="password" class="form-control @error('current_password','updatePassword') is-invalid @enderror" placeholder="" required>
                                                    @error('current_password','updatePassword')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endisset
                                        <div class="col-md-4">
                                            <label class="p-1">رمز عبور جدید *</label>
                                            <div class="mb-3">
                                                <input name="password" type="password" class="form-control @error('password','updatePassword') is-invalid @enderror" placeholder="" required>
                                                @error('password','updatePassword')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="p-1">تکرار رمز عبور * </label>
                                            <div class="mb-3">
                                                <input name="password_confirmation" type="password" class="form-control @error('password_confirmation','updatePassword') is-invalid @enderror" placeholder="" required>
                                                @error('password_confirmation','updatePassword')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-auto align-self-center">
                                            <button type="submit" class="btn btn-raised btn-primary waves-effect">ذخیره</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
