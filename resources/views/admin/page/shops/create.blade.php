@extends('admin.layout.MasterAdmin')
@section('title', 'ایجاد فروشگاه')

@section('Content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>ایجاد فروشگاه</h2>
                        </br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.shop.index') }}"> فروشگاه ها</a></li>
                            <li class="breadcrumb-item active">ایجاد فروشگاه</li>
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

                <!-- Hover Rows -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <form id="form_advanced_validation" class="needs-validation"
                                    action={{ route('admin.shop.store') }} method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row clearfix">

                                        <div class="col-md-4">
                                            <label for="name">فروشنده</label>
                                            <div class="form-group">
                                                <select id="user_id" name="user_id"
                                                    class="form-control show-tick ms select2">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">
                                                            {{ $user->cellphone }} - {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="name">نام نام خانوادگی فروشنده</label>
                                            <div class="form-group">
                                                <input type="text" name="name" id="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="cellphone">شماره تماس</label>
                                            <div class="form-group">
                                                <input type="text" name="cellphone" id="cellphone"
                                                    class="form-control @error('cellphone') is-invalid @enderror"
                                                    value="{{ old('cellphone') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="shopname">نام فروشگاه</label>
                                            <div class="form-group">
                                                <input type="text" name="shopname" id="shopname"
                                                    class="form-control @error('shopname') is-invalid @enderror"
                                                    value="{{ old('shopname') }}" required>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 @error('address') is-invalid @enderror">
                                            <label>آدرس فروشگاه</label>
                                            <div>
                                                <textarea class="form-control" name="address"></textarea>
                                            </div>
                                            @error('address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="priority"> اولویت</label>
                                            <div class="form-group">
                                                <input type="number" name="priority" id="priority"
                                                    class="form-control @error('priority') is-invalid @enderror"
                                                    value="{{ old('priority') }}" required>
                                            </div>
                                        </div>
                                        <div class="sub-feature col-lg-3 col-md-4 col-sm-6 align-self-center">
                                            <div class="checkbox">
                                                <input id="check" {{ old('is_home') === 'on' ? 'checked' : '' }}
                                                    type="checkbox" name="is_home">
                                                <label for="check"> نمایش در صفحه اصلی </label>
                                            </div>
                                        </div>

                                        <div class="sub-feature col-lg-3 col-md-4 col-sm-6 align-self-center">
                                            <div class="checkbox">
                                                <input id="check1" {{ old('is_active') === 'on' ? 'checked' : '' }}
                                                    type="checkbox" name="is_active">
                                                <label for="check1">وضعیت</label>
                                            </div>
                                        </div>
                                        <div class="creditcart col-md-6">
                                            <label for="cart_number">شماره کارت</label>
                                            <img width="32px" src="/bank-iran/no-img.png">
                                            <input type="text" name="cart_number" class="creditcart-input form-control"
                                                value="{{ old('cart_number') }}" maxlength="16"
                                                placeholder="شماره کارت را وارد کنید">
                                        </div>

                                        <div class="shaba-number col-md-6">
                                            <label for="priority">شماره شبا</label>
                                            <img width="32px" src="/bank-iran/no-img.png">
                                            <input type="text" class="shaba-input form-control" maxlength="24"
                                                value="{{ old('shaba_number') }}" name="shaba_number"
                                                style="direction:ltr">
                                            <span>بدون IR</span>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="image">تصویر</label>
                                            <span class="position_message" id="position_message"></span>
                                            <div class=" form-group">
                                                <input name="image" id="image" type="file"
                                                    class="dropify form-controll" required
                                                    data-allowed-file-extensions="jpg png jpeg svg"
                                                    data-max-file-size="1024K">
                                                @error('image')
                                                    <span class="text-danger m-0">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img class="bone mt-5" />
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="form-group col-md-12 @error('description') is-invalid @enderror">
                                            <label for="summernote">توضیحات</label>
                                            <div wire:ignore>
                                                <textarea class="form-control summernote-editor" name="description" id="summernote"></textarea>
                                            </div>
                                            @error('description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-raised btn-primary waves-effect">ذخیره
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Hover Rows -->
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
