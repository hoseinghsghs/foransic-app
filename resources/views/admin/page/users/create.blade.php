@extends('admin.layout.MasterAdmin')
@section('title', 'افزودن کاربر')

@section('Content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>افزودن کاربر</h2>
                        </br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">کاربران</a></li>
                            <li class="breadcrumb-item active">افزودن کاربر</li>
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
                                    action="{{ route('admin.users.store') }}" method="POST">
                                    @method('POST')
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="col-md-3">
                                            <label for="title">کاربر</label>
                                            <div class="form-group">
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name') }}" placeholder="نام خانوادگی - رده استان">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="text">نام کاربری (کد پرسنلی)</label>
                                            <div class="form-group">
                                                <input type="text" name="username"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    value="{{ old('username') }}">
                                                @error('username')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="text"> موبایل</label>
                                            <div class="form-group">
                                                <input type="number" name="cellphone"
                                                    class="form-control without-spin @error('cellphone') is-invalid @enderror"
                                                    value="{{ old('cellphone') }}">
                                                @error('cellphone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="password">رمز عبور <abbr class="required" title="ضروری"
                                                    style="color:red;">*</abbr></label>
                                            <div class="form-group">
                                                <input type="text" required name="password" id="password"
                                                    class="form-control @error('password') is-invalid @enderror">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="type">نقش کاربری</label>
                                            <div class="form-group">
                                                <select id="positionSelect" name="role" data-placeholder="انتخاب نقش"
                                                    class="form-control ms select2">
                                                    <option value='false'>بدون نقش</option>
                                                    @forelse ($roles as $role)
                                                        <option value="{{ $role->name }}" @selected(old('role') == $role->name)>
                                                            {{ $role->display_name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                @error('role')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        @if(is_null(auth()->user()->laboratory_id))
                                            @php($laboratories=\App\Models\Laboratory::all())
                                            @if ()

                                            @endif
                                            <div
                                                class="form-group col-md-3 col-sm-3 @error('laboratory_id') is-invalid @enderror">
                                                <label for="userSelect">آزمایشگاه <abbr class="required text-danger"
                                                                                        title="ضروری">*</abbr></label>
                                                    <select id="laboratorySelect" name="laboratory_id"
                                                            data-placeholder="انتخاب آزمایشگاه"
                                                            class="form-control ms search-select">
                                                        <option></option>
                                                        @foreach ($laboratories as $laboratory)
                                                            <option value={{ $laboratory->id }}>
                                                                {{ $laboratory->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @error('laboratory_id')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ route('admin.users.index') }}"
                                            class="btn btn-secondary ml-md-3">بازگشت</a>
                                        <button type="submit" class="btn btn-raised btn-primary waves-effect">
                                            ذخیره
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
    @push('scripts')

    @endpush

@endsection
