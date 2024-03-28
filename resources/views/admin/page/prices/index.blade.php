@extends('admin.layout.MasterAdmin')
@section('Content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>تغییر قیمت</h2>
                        </br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}>فروشگاه</a></li>
                            <li class="breadcrumb-item active">تغییر دسته ای</li>
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
                {{-- baseprice --}}
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <strong>قیمت پایه</strong>
                                </h2>
                            </div>
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
                                <form id="form_advanced_validation" class="needs-validation"
                                    action={{ route('admin.prices.baseupdate') }} method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="form-group col-sm-4 ">
                                            <label for="categorySelect">
                                                دسته بندی*</label>
                                            <div>
                                                <select id="categorySelect" data-placeholder="انتخاب دسته" required
                                                    name="category" class="form-control ms select2-styled"
                                                    data-live-search="true">
                                                    <option></option>
                                                    @foreach ($categories->sortBy('order') as $category1)
                                                        <optgroup label="{{ $category1->name }}">
                                                            @if ($category1->children->count() > 0)
                                                                @foreach ($category1->children->sortBy('order') as $category2)
                                                                    <option class="pr-2" value="{{ $category2->id }}">
                                                                        &#8617;
                                                                        {{ $category2->name }}</option>
                                                                    @if ($category2->children->count() > 0)
                                                                        @foreach ($category2->children->sortBy('order') as $category3)
                                                                            <option class="pr-4"
                                                                                value="{{ $category3->id }}">&#10510;
                                                                                {{ $category3->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <div class="form-group form-float">
                                                <label for="type">نوع</label>
                                                <select id="type" name="type" data-placeholder="انتخاب نوع"
                                                    class="form-control">
                                                    <option>درصدی</option>
                                                    <option disabled>مبلغی</option>
                                                </select>
                                                @error('category')
                                                    <span class="text-danger m-0">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-5 ">
                                            <div class="form-group form-float">
                                                <label for="amount">مقدار *</label>
                                                <input dir="ltr" required id="amount" class="form-control"
                                                    name="amount" type="number" value="{{ old('amount') }}">
                                                @error('amount')
                                                    <span class="text-danger m-0">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-raised btn-primary waves-effect">
                                            تغییر
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- endbaseprice --}}



                {{-- grantee --}}
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <strong>گارانتی</strong>
                                </h2>
                            </div>
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
                                <form id="form_advanced_validation" class="needs-validation"
                                    action={{ route('admin.updateguarantee') }} method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="form-group col-sm-4 ">
                                            <label for="categorySelect">
                                                دسته بندی*</label>
                                            <div>
                                                <select id="categorySelect" data-placeholder="انتخاب دسته" required
                                                    name="category" class="form-control ms select2-styled"
                                                    data-live-search="true">
                                                    <option></option>
                                                    @foreach ($categories->sortBy('order') as $category1)
                                                        <optgroup label="{{ $category1->name }}">
                                                            @if ($category1->children->count() > 0)
                                                                @foreach ($category1->children->sortBy('order') as $category2)
                                                                    <option class="pr-2" value="{{ $category2->id }}">
                                                                        &#8617;
                                                                        {{ $category2->name }}</option>
                                                                    @if ($category2->children->count() > 0)
                                                                        @foreach ($category2->children->sortBy('order') as $category3)
                                                                            <option class="pr-4"
                                                                                value="{{ $category3->id }}">&#10510;
                                                                                {{ $category3->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <div class="form-group form-float">
                                                <label for="type">گارانتی</label>
                                                <input dir="ltr" required id="guarantee" class="form-control"
                                                    name="guarantee" type="text" value="{{ old('guarantee') }}">
                                                @error('guarantee')
                                                    <span class="text-danger m-0">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-5 ">
                                            <div class="form-group form-float">
                                                <label for="time_guarantee">زمان گارانتی *</label>
                                                <input dir="ltr" required id="time_guarantee" class="form-control"
                                                    name="time_guarantee" type="text"
                                                    value="{{ old('time_guarantee') }}">
                                                @error('time_guarantee')
                                                    <span class="text-danger m-0">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-raised btn-primary waves-effect">
                                            تغییر
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- grantee --}}


                {{-- delivery --}}
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    <strong>هزینه ارسال</strong>
                                </h2>
                            </div>
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
                                <form id="form_advanced_validation" class="needs-validation"
                                    action={{ route('admin.updatedelivery') }} method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="form-group col-sm-4 ">
                                            <label for="categorySelect">
                                                دسته بندی*</label>
                                            <div>
                                                <select id="categorySelect" data-placeholder="انتخاب دسته" required
                                                    name="category" class="form-control ms select2-styled"
                                                    data-live-search="true">
                                                    <option></option>
                                                    @foreach ($categories->sortBy('order') as $category1)
                                                        <optgroup label="{{ $category1->name }}">
                                                            @if ($category1->children->count() > 0)
                                                                @foreach ($category1->children->sortBy('order') as $category2)
                                                                    <option class="pr-2" value="{{ $category2->id }}">
                                                                        &#8617;
                                                                        {{ $category2->name }}</option>
                                                                    @if ($category2->children->count() > 0)
                                                                        @foreach ($category2->children->sortBy('order') as $category3)
                                                                            <option class="pr-4"
                                                                                value="{{ $category3->id }}">&#10510;
                                                                                {{ $category3->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('category_id')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <div class="form-group form-float">
                                                <label for="type">هزینه حمل و نقل</label>
                                                <input dir="ltr" required id="delivery_amount" class="form-control"
                                                    name="delivery_amount" type="text"
                                                    value="{{ old('delivery_amount') }}">
                                                @error('delivery_amount')
                                                    <span class="text-danger m-0">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-5 ">
                                            <div class="form-group form-float">
                                                <label for="delivery_amount_per_product">هزینه حمل و نقل به ازای محصول
                                                    اضافی *</label>
                                                <input dir="ltr" required id="delivery_amount_per_product"
                                                    class="form-control" name="delivery_amount_per_product"
                                                    type="text" value="{{ old('delivery_amount_per_product') }}">
                                                @error('delivery_amount_per_product')
                                                    <span class="text-danger m-0">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-raised btn-primary waves-effect">
                                            تغییر
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- delivery --}}


            </div>
        </div>
    </section>
@endsection
