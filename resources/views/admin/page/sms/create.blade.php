@extends('admin.layout.MasterAdmin')

@section('Content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>ارسال اس ام اس</h2>
                        </br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            {{--                            <li class="breadcrumb-item"><a href={{ route('admin.posts.index') }}>لیست پست ها</a></li>--}}
                            <li class="breadcrumb-item active">ارسال اس ام اس</li>
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
                                      action={{ route('admin.sms.sendSms') }} method="POST">
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="form-group col-md-4">
                                            <label for="receivers">انتخاب گیرندگان</label>
                                            <select id="receivers" name="receivers" data-placeholder="انتخاب گیرندگان"
                                                    class="form-control select2 @error('receivers') is-invalid @enderror">
                                                <option value="0">همه کاربران سایت</option>
                                                <option value="1">خریداران</option>
                                            </select>
                                            @error('receivers')
                                            <span class="text-danger m-0">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="message-text" class="form-label">متن پیام</label>
                                            <textarea id="message-text" name="text"
                                                      class="form-control @error('text') is-invalid @enderror"
                                                      required></textarea>
                                        </div>
                                        <div class="form-group col-12">
                                            <button type="submit" class="btn btn-raised btn-primary waves-effect">
                                                ارسال
                                            </button>
                                        </div>
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
