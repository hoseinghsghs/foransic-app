@extends('home.layout.MasterHome')
@section('title', $product->category->name . ' | قیمت و خرید ' . $product->name)
@section('content')
    <div class="container-main">
        <div class="d-block">
            <div class="page-content page-row">
                <div class="main-row">
                    <div id="breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="mdi mdi-home"></i>خانه
                                    </a></li>
                                @foreach (product_categories($product) as $category)
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('home.products.search', $category->slug) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg">
                        <div class="product type-product">
                            <div class="col-lg-5 col-xs-12 pr d-block pr-lg-0">
                                <section class="product-gallery">
                                    <div class="gallery row mx-0">
                                        <div class="gallery-item col-lg-auto col-xs-1 pr p-0">
                                            <div>
                                                <ul class="gallery-actions">
                                                    <li>
                                                        @if (Auth::check())
                                                            @if ($product->checkUserWishlist(auth()->user()->id))
                                                                <a href="#" data-product="{{ $product->id }}"
                                                                    class="btn-option add-product-wishes active">
                                                                    <i class="fa fa-heart-o"></i>
                                                                    <span>محبوب</span>
                                                                </a>
                                                            @else
                                                                <a href="#" data-product="{{ $product->id }}"
                                                                    class="btn-option add-product-wishes ">
                                                                    <i class="fa fa-heart-o"></i>
                                                                    <span>محبوب</span>
                                                                </a>
                                                            @endif
                                                        @else
                                                            <a href="#" data-product="{{ $product->id }}"
                                                                class="btn-option add-product-wishes ">
                                                                <i class="fa fa-heart-o"></i>
                                                                <span>محبوب</span>
                                                            </a>
                                                        @endif
                                                    </li>
                                                    <li class="option-social">
                                                        <a href="#" class="btn-option btn-option-social"
                                                            data-toggle="modal" data-target="#option-social">
                                                            <i class="fa fa-share-alt"></i>
                                                            <span>اشتراک</span>
                                                        </a>
                                                        <!-- Modal-option-social -->
                                                        <div class="modal fade" id="option-social" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalCenterTitle">اشتراک گذاری
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="title">با استفاده از روش‌های زیر
                                                                            می‌توانید این صفحه را با دیگران به اشتراک
                                                                            بگذارید.
                                                                            <div class="share-options">
                                                                                <div
                                                                                    class="share-social-buttons text-center">
                                                                                    <a href="https://www.linkedin.com/shareArticle?mini=true&title={{ route('home.products.show', ['product' => $product->slug]) }}"
                                                                                        class="share-social share-social-twitter">
                                                                                        <i class="mdi mdi-linkedin"></i>
                                                                                    </a>
                                                                                    <a href="https://telegram.me/share/url?url={{ route('home.products.show', ['product' => $product->slug]) }}"
                                                                                        class="share-social share-social-facebook">
                                                                                        <i class="mdi mdi-telegram"></i>
                                                                                    </a>
                                                                                    <a href="https://web.whatsapp.com/send?text={{ route('home.products.show', ['product' => $product->slug]) }}"
                                                                                        class="share-social share-social-whatsapp">
                                                                                        <i class="mdi mdi-whatsapp"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="Three-dimensional">
                                                        <a href="" data-product="{{ $product->id }}"
                                                            @class([
                                                                'btn-option btn-compare',
                                                                'text-primary' =>
                                                                    session()->has('compareProducts') &&
                                                                    in_array($product->id, session()->get('compareProducts')),
                                                            ])>
                                                            <i class="fa fa-random"></i>
                                                            <span>مقایسه</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="gallery-item col-lg col-xs-11 pr">
                                            <div class="gallery-img mx-auto" style="max-width: 420px">
                                                <img class="zoom-img w-100" id="img-product-zoom"
                                                    alt="{{ $product->name }}"
                                                    src="{{ url(env('PRODUCT_PRIMARY_IMAGES_UPLOAD_PATCH') . $product->primary_image) }}"
                                                    data-zoom-image="{{ url(env('PRODUCT_PRIMARY_IMAGES_UPLOAD_PATCH') . $product->primary_image) }}" />
                                                <div id="gallery_01f">
                                                    <ul class="gallery-items owl-carousel owl-theme" id="gallery-slider">
                                                        <li class="item" style="padding: 4px">
                                                            <a href="#" class="elevatezoom-gallery active"
                                                                data-update=""
                                                                data-image="{{ url(env('PRODUCT_PRIMARY_IMAGES_UPLOAD_PATCH') . $product->primary_image) }}"
                                                                data-zoom-image="{{ url(env('PRODUCT_PRIMARY_IMAGES_UPLOAD_PATCH') . $product->primary_image) }}">
                                                                <img src="{{ url(env('PRODUCT_PRIMARY_IMAGES_UPLOAD_PATCH') . $product->primary_image) }}"
                                                                    width="100" alt="{{ $product->name }}" />
                                                            </a>
                                                        </li>
                                                        @foreach ($product->images as $image_value)
                                                            <li class="item" style="padding: 4px">
                                                                <a href="#" class="elevatezoom-gallery" data-update=""
                                                                    data-image="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATCH') . $image_value->image) }}"
                                                                    data-zoom-image="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATCH') . $image_value->image) }}">
                                                                    <img src="{{ url(env('PRODUCT_IMAGES_UPLOAD_PATCH') . $image_value->image) }}"
                                                                        width="100" alt="{{ $product->name }}" />
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-lg-7 col-xs-12 pl d-block p-0">
                                <section class="product-info">
                                    <div class="product-headline">
                                        <h1 class="product-title">
                                            {{ $product->name }}
                                        </h1>
                                        <div class="product-guaranteed" style="color: #0089ff !important;">
                                            میزان رضایت:
                                            <span><span data-rating-stars="5" data-rating-readonly="true"
                                                    data-rating-value="{{ ceil($product->rates->avg('satisfaction')) }}">
                                                </span></span>
                                        </div>
                                    </div>

                                    <div class="product-config-wrapper">
                                        @php
                                            if ($product->sale_check) {
                                                $variationProductSelected = $product->sale_check;
                                            } else {
                                                $variationProductSelected = $product->price_check;
                                            }
                                        @endphp
                                        <div class="col=lg-7 col-md-7 col-sm-6 pr p-0">
                                            <div class="product-params">
                                                @if ($product->quantity_check)
                                                    <div class="mt-3"
                                                        style="
    border-top: solid 1px #ccc;
    line-height: 3rem;
    width:91%
">
                                                        <p class="font-weight-bold mb-2">
                                                            {{ App\Models\Attribute::find($product->variations->first()->attribute_id)->name }}
                                                        </p>
                                                        <div class="form-group">
                                                            <select name="variation" id="var-select"
                                                                class="select-var form-control form-control-sm w-auto mw-100"
                                                                id="varition">
                                                                @php
                                                                    $var = $product
                                                                        ->variations()
                                                                        ->where('quantity', '>', 0)
                                                                        ->get();
                                                                @endphp @foreach ($var as $variation)
                                                                    <option
                                                                        value="{{ json_encode($variation->only(['id', 'sku', 'guarantee', 'time_guarantee', 'quantity', 'is_sale', 'sale_price', 'price'])) }}"
                                                                        {{ $variationProductSelected->id == $variation->id ? 'selected' : '' }}>
                                                                        {{ $variation->value }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($main_attributes->count() > 0)
                                                    <ul data-title="ویژگی‌های محصول">
                                                        @foreach ($main_attributes as $attribute)
                                                            <li class="mt-3">
                                                                <span>{{ $attribute->attribute->name }}:</span>
                                                                <span style="color: black">{{ $attribute->value }}</span>
                                                            </li>
                                                        @endforeach
                                                        @if ($product->brand)
                                                            <li class="mt-4">
                                                                <span>
                                                                    برند:
                                                                </span>
                                                                <a href="{{ route('home.products.search', ['brand' => $product->brand->slug]) }}"
                                                                    class="product-link product-tag-title">{{ $product->brand->name }}</a>
                                                            </li>
                                                        @endif
                                                        <li class="mt-5">
                                                            <span>
                                                                <i class="fa fa-archive"></i> دسته:
                                                            </span>
                                                            @foreach (product_categories($product) as $category)
                                                                <a href="{{ route('home.products.search', $category->slug) }}"
                                                                    class="product-link product-cat-title">{{ $category->name }}</a>
                                                                @if (!$loop->last)
                                                                    ,
                                                                @endif
                                                            @endforeach
                                                        </li>
                                                        @if ($product->tags->count() > 0)
                                                            <li>
                                                                <span>
                                                                    <i class="fa fa-tags"></i> برچسب:
                                                                </span>
                                                                @foreach ($product->tags as $tag)
                                                                    <a href="{{ route('home.products.search', ['tag' => $tag->name]) }}"
                                                                        class="product-link product-tag-title">{{ $tag->name }}
                                                                        ،</a>
                                                                @endforeach
                                                            </li>

                                                        @endif
                                                    </ul>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col=lg-5 col-md-5 col-sm-6 pr p-0">
                                            <div class="product-seller-info mt-0" style="background-color: #f5eff480">
                                                <div class="seller-info-changable">
                                                    @if (!$product->contact)
                                                        <div class="product-seller-row vendor">

                                                            <span class="title " style="border-bottom: 1px dashed;">
                                                                فروشنده:</span>
                                                            </br>
                                                            <div class="mt-4">
                                                                <img src="{{ asset('img/singelproduct/stars.svg') }}"
                                                                    style="float: right" height="32rem" class="p-1"
                                                                    alt="فروشنده" />
                                                                <a class="product-name"
                                                                    style="float: right">{{ env('APP_NAME') }}</a>
                                                            </div>
                                                        </div>
                                                        @if ($product->quantity_check)
                                                            <div class="product-seller-row guarantee1">

                                                                <img src="{{ asset('img/singelproduct/guarantee-icon.svg') }}"
                                                                    style="float: right" height="32rem" class="p-1"
                                                                    alt="کارانتی" />
                                                                <span class="title " style="border-bottom: 1px dashed;">
                                                                    گارانتی :
                                                                </span>

                                                                <a class="product-name mr-2" id="guarantee"
                                                                    style="float: right"></a>
                                                            </div>
                                                            <div class="product-seller-row guarantee2">
                                                                <img src="{{ asset('img/singelproduct/time2.svg') }}"
                                                                    style="float: right" height="28rem" class="p-1"
                                                                    alt="فروشنده" />
                                                                <span class="title" style="border-bottom: 1px dashed;">
                                                                    مدت
                                                                    گارانتی : </span>
                                                                <a class="product-name mr-2" id="time_guarantee"
                                                                    style="float: right"></a>

                                                            </div>
                                                        @endif
                                                        <div class="product-seller-row guarantee2">
                                                            <img src="{{ asset('img/singelproduct/code.svg') }}"
                                                                style="float: right" height="28rem" class="p-1"
                                                                alt="فروشنده" />
                                                            <span class="title" style="border-bottom: 1px dashed;">
                                                                کدمحصول : </span>
                                                            <a class="product-name mr-2" id="time_guarantee"
                                                                style="float: right"> <span class="sku product-title-en">
                                                                </span> </a>
                                                        </div>
                                                        <div class="product-seller-row price">
                                                            <img src="{{ asset('img/singelproduct/label.svg') }}"
                                                                style="float: right" height="28rem" class="p-1"
                                                                alt="فروشنده" />
                                                            <span class="title"
                                                                style="
    border-bottom: 1px dashed;
">قیمت:</span>


                                                            <a class="product-name variation-price mr-2"
                                                                style="float: right">
                                                                @if ($product->quantity_check)
                                                                    @if ($product->sale_check)
                                                                        <div class="amount">
                                                                            {{ number_format($product->sale_check->sale_price) }}
                                                                            تومان
                                                                        </div> </br>
                                                                        <del>
                                                                            {{ number_format($product->sale_check->price) }}
                                                                            تومان
                                                                        </del>
                                                                    @else
                                                                        <span
                                                                            class="amount">{{ number_format($product->price_check->price) }}
                                                                            تومان</span>
                                                                    @endif
                                                                @else
                                                                    <span class="amount text-danger"></span>
                                                                @endif
                                                            </a>
                                                        </div>

                                                        @if ($product->quantity_check)
                                                            <div class="product-seller-row guarantee">
                                                                <span class="title mt-4 mr-4"> تعداد:</span>
                                                                <div class="quantity pl">
                                                                    <input type="number" class="numberstyle"
                                                                        min="1" step="1" name="qtybutton"
                                                                        id="qtybutton" readonly value="1">
                                                                    <div class="quantity-nav">
                                                                        <div class="quantity-button quantity-up">+</div>
                                                                        <div class="quantity-button quantity-down">-
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" id="product_id" name="product"
                                                                value="{{ $product->id }}">
                                                            <div class="product-seller-row add-to-cart">
                                                                <a href="#" class="btn-add-to-cart btn btn-primary"
                                                                    data-ishome="0">
                                                                    <i class="fa fa-shopping-cart"></i>
                                                                    <span class="btn-add-to-cart-txt">افزودن به سبد
                                                                        خرید</span>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="product-seller-row add-to-cart">
                                                                <button class="pro-non-existent btn btn-danger"
                                                                    data-ishome="0">
                                                                    <i class="fa fa-bullhorn"> </i>
                                                                    <span class="btn-add-to-cart-txt"> ناموجود</span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="product-seller-row vendor">
                                                            <span class="title"> فروشنده:</span>
                                                            <a class="product-name">{{ env('APP_NAME') }}</a>
                                                        </div>
                                                        <div class="product-seller-row guarantee2">
                                                            <span class="title"> کد محصول :</span>
                                                            <a class="product-name"><span
                                                                    class="sku product-title-en"></span></a>
                                                        </div>

                                                        <div class="product-seller-row add-to-cart">
                                                            <a class="pro-non-existent btn btn-danger"
                                                                style="font-size: 0.72rem" href="tel:09139035692">لطفا
                                                                تماس بگیرید</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs mt-0" id="respon">
                <div class="tab-box">
                    <ul class="tab nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ count($errors) > 0 ? '' : 'active' }} " id="Review-tab"
                                style="margin-left: -1.6rem;" data-toggle="tab" href="#Review" role="tab"
                                aria-controls="Review" aria-selected="{{ count($errors) > 0 ? 'false' : 'true' }}">
                                <i class="mdi mdi-glasses"></i>
                                توضیح
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Specifications-tab" style="margin-left: -1.6rem;" data-toggle="tab"
                                href="#Specifications" role="tab" aria-controls="Specifications"
                                aria-selected="false">
                                <i class="mdi mdi-format-list-checks"></i>
                                مشخصات
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="User-comments-tab" style="margin-left: -1.6rem;" data-toggle="tab"
                                href="#User-comments" role="tab" aria-controls="User-comments"
                                aria-selected="false">
                                <i class="mdi mdi-comment-text-multiple-outline"></i>
                                نظرات
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ count($errors) > 0 ? 'active' : '' }}" style="margin-left: -1.6rem;"
                                id="question-and-answer-tab" data-toggle="tab" href="#question-and-answer"
                                role="tab" aria-controls="question-and-answer"
                                aria-selected="{{ count($errors) > 0 ? 'true' : 'false' }}">
                                <i class="mdi mdi-comment-question-outline"></i>
                                پرسش و پاسخ
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg">
                    <div class="tabs-content">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade {{ count($errors) > 0 ? '' : 'show active' }}" id="Review"
                                role="tabpanel" aria-labelledby="Review-tab">
                                <h5 class="params-headline">نقد و بررسی اجمالی</h5>
                                <section class="content-expert-summary">
                                    <div class="mask pm-3">
                                        <div class="mask-text">
                                            <p>
                                                {!! $product->description !!}
                                            </p>
                                            @if ($product->keywords->count() > 0)

                                                @foreach ($product->keywords as $keywords)
                                                    <strong>{{ $keywords->title }}

                                                        @if (!$loop->last)
                                                            ،
                                                        @endif

                                                    </strong>
                                                @endforeach
                                            @endif
                                        </div>
                                        <a href="#" class="mask-handler">
                                            <span class="show-more">+ ادامه مطلب</span>
                                            <span class="show-less">- بستن</span>
                                        </a>
                                        <div class="shadow-box"></div>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="Specifications" role="tabpanel"
                                aria-labelledby="Specifications-tab">
                                <article>
                                    <span class="params-headline">مشخصات فنی
                                        <span>{{ $product->name }}</span>
                                    </span>
                                    <section>
                                        <ul class="params-list">
                                            @foreach ($product->attributes()->with('attribute')->get() as $attribute)
                                                <li class="params-list-item">
                                                    <div class="params-list-key">
                                                        <span class="block">{{ $attribute->attribute->name }}</span>
                                                    </div>
                                                    <div class="params-list-value">
                                                        <span class="block">
                                                            {{ $attribute->value }}
                                                        </span>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </section>
                                </article>
                            </div>
                            <div class="tab-pane fade" id="User-comments" role="tabpanel"
                                aria-labelledby="User-comments-tab">
                                <div class="comments">
                                    <span class="params-headline">امتیاز کاربران به
                                        <span>{{ $product->name }}</span>
                                    </span>
                                    <div class="comments-summary">
                                        <div class="col-lg-6 col-md-6 col-xs-12 pr">
                                            <div class="comments-summary-box">
                                                <ul class="comments-item-rating">
                                                    <li>
                                                        <span class="cell-title">ارزش خرید نسبت به قیمت
                                                            :</span>
                                                        <span class="cell-value"></span>
                                                        <div class="rating-general">
                                                            <div class="rating-value"
                                                                style="width: {{ (ceil($product->rates->avg('cost')) * 100) / 5 }}%;">
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <span class="cell-title">کیفیت:</span>
                                                        <span class="cell-value"></span>
                                                        <div class="rating-general">
                                                            <div class="rating-value"
                                                                style="width: {{ (ceil($product->rates->avg('quality')) * 100) / 5 }}%;">
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <span class="cell-title">میزان رضایت کلی از محصول
                                                            :</span>
                                                        <span class="cell-value"></span>
                                                        <div class="rating-general">
                                                            <div class="rating-value"
                                                                style="width: {{ (ceil($product->rates->avg('satisfaction')) * 100) / 5 }}%;">
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12 pr">
                                            <div class="comments-summary-note">
                                                <h6>شما هم می‌توانید در مورد این کالا نظر بدهید.</h6>
                                                <p>
                                                    برای ثبت نظر، لازم است ابتدا وارد حساب کاربری خود شوید. اگر این
                                                    محصول را قبلا خریده باشید،
                                                    نظر
                                                    شما به عنوان مالک محصول ثبت خواهد شد.
                                                </p>
                                                @if (auth()->user())
                                                    @foreach (auth()->user()->orders as $order)
                                                        @php
                                                            $cheak_item = App\Models\OrderItem::where('order_id', $order->id)
                                                                ->where('product_id', $product->id)
                                                                ->first();
                                                        @endphp
                                                    @endforeach
                                                    @if (isset($cheak_item))
                                                        <button type="button" class="btn-add-comment btn btn-secondary"
                                                            data-toggle="modal" data-target="#comment-modal">
                                                            ارسال نظر
                                                        </button>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-comment-list">
                                            <ul class="comment-list">
                                                @foreach ($product->approvedComments as $comment)
                                                    <li style="border: 1px solid #d4c2f7;border-radius: 20px;">
                                                        <div class="col-lg-3 pr">
                                                            <section>
                                                                <div class="comments-user-shopping mt-3 mr-1 p-2 row">
                                                                    <div class="col-6 mt-2">
                                                                        <img src="/assets/home/images/man.png"
                                                                            alt="">
                                                                    </div>
                                                                    <div class="col-6">
                                                                        {{ $comment->user->name == null ? 'بدون نام' : $comment->user->name }}
                                                                        <div class="cell-date">
                                                                            {{ Hekmatinasser\Verta\Verta::instance($comment->created_at)->format('Y/n/j') }}
                                                                        </div>
                                                                        <span data-rating-stars="5"
                                                                            data-rating-readonly="true"
                                                                            data-rating-value="{{ ceil($comment->commentable->rates->avg('satisfaction')) }}">
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div class="col-lg-9 pl">
                                                            <div class="article">
                                                                <ul class="comment-text">
                                                                    <div class="header">
                                                                        <div>{{ $comment->title }}</div>
                                                                        <p>{{ $comment->text }}</p>
                                                                    </div>
                                                                    <div class="comments-evaluation">
                                                                        <div class="comments-evaluation-positive">
                                                                            <span>نقاط قوت</span>
                                                                            <ul>
                                                                                @php
                                                                                    $comment['advantages'] = json_decode($comment->advantages);
                                                                                @endphp
                                                                                @foreach ($comment->advantages as $item)
                                                                                    <li>
                                                                                        {{ $item }}
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                        <div class="comments-evaluation-negative">
                                                                            <span>نقاط ضعف</span>
                                                                            <ul>
                                                                                @php
                                                                                    $comment['disadvantages'] = json_decode($comment->disadvantages);
                                                                                @endphp
                                                                                @foreach ($comment->disadvantages as $item)
                                                                                    <li>
                                                                                        {{ $item }}
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade {{ count($errors) > 0 ? 'show active' : '' }}"
                                id="question-and-answer" role="tabpanel" aria-labelledby="question-and-answer-tab">
                                <div class="faq">
                                    <form action="{{ route('home.questions.store', ['product' => $product->id]) }}"
                                        method="POST" class="review-form">
                                        @csrf
                                        <div class="form-faq-row mt-2">
                                            <div class="form-faq-col">
                                                <div class="ui-textarea">
                                                    <textarea title="متن سوال" placeholder="متن پرسش و پاسخ ..... " name="text" cols="30" rows="6"
                                                        id="review" class="ui-textarea-field"></textarea>
                                                    @error('text')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-faq-row mt-2">
                                            <div class="form-faq-col form-faq-col-submit">
                                                <button class="btn-tertiary btn-question-singel" type="submit">ثبت

                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="product-questions-list">
                                        @foreach ($product->approvedQuestions as $question)
                                            <div class="questions-list mb-2">
                                                <ul class="faq-list">
                                                    <li class="is-question">
                                                        <div class="section">
                                                            <div class="faq-header">
                                                                <span class="icon-faq">?</span>
                                                                <h6>
                                                                    پرسش :
                                                                    @if ($question->user->hasRole('super-admin'))
                                                                        <span style="color: orange">مدیر سایت</span>
                                                                    @else
                                                                        <span>{{ $question->user->name == null ? 'بدون نام' : $question->user->name }}</span>
                                                                    @endif
                                                                </h6>
                                                                <p>{!! $question->text !!}</p>
                                                            </div>
                                                            <a onclick="reply('{{ $question->id }}')"
                                                                class="btn btn-link" id="btn-question-show">
                                                                پاسخ
                                                                <i class="fa fa-reply"></i>
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <form style="margin-right: 4rem;margin-left: 4px;display: none;"
                                                id="reply-form-{{ $question->id }}"
                                                action="{{ route('questions.reply.add', ['product' => $product->id, 'question' => $question->id]) }}"
                                                method="POST" class="review-form ">
                                                @csrf
                                                <div class="form-faq-col">
                                                    <textarea name="text" cols="30" rows="5" placeholder="پاسخ ..." class="form-control mt-2"
                                                        id="review"></textarea>
                                                    @error('text')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <button class="btn btn-sm btn-primary mt-2" type="submit">
                                                        ثبت
                                                        پاسخ
                                                    </button>
                                                </div>
                                            </form>
                                            @foreach ($question->replies as $reply)
                                                @if ($reply->approved == 1)
                                                    <div class="questions-list answer-questions">
                                                        <ul class="faq-list">
                                                            <li class="is-question">
                                                                <div class="section">
                                                                    <div class="faq-header">
                                                                        <span class="icon-faq"><i
                                                                                class="fa fa-reply"></i></span>
                                                                        <h6>
                                                                            پاسخ :
                                                                            @if ($reply->user->hasRole('super-admin'))
                                                                                <span style="color: orange">مدیر
                                                                                    سایت</span>
                                                                            @else
                                                                                <span>{{ $reply->user->name == null ? 'بدون نام' : $reply->user->name }}</span>
                                                                            @endif
                                                                        </h6>
                                                                    </div>
                                                                    <div style="word-wrap: break-word;">
                                                                        <span>{!! $reply->text !!}</span>
                                                                    </div>
                                                                    <div class="faq-date">
                                                                        <em>{{ Hekmatinasser\Verta\Verta::instance($reply->created_at)->format('Y/n/j') }}</em>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    @foreach ($reply->replies as $reply)
                                                        @if ($reply->approved == 1)
                                                            <div class="questions-list answer-questions"
                                                                style="width: 89% !important;">
                                                                <ul class="faq-list">
                                                                    <li class="is-question">
                                                                        <div class="section">
                                                                            <div class="faq-header">
                                                                                <span class="icon-faq"
                                                                                    style="size:3rem ;"><i
                                                                                        class="fa fa-reply-all"></i></span>
                                                                                <h6>
                                                                                    پاسخ :
                                                                                    @if ($reply->user->hasRole('super-admin'))
                                                                                        <span style="color: orange">مدیر
                                                                                            سایت</span>
                                                                                    @else
                                                                                        <span>{{ $reply->user->name == null ? 'بدون نام' : $reply->user->name }}</span>
                                                                                    @endif
                                                                                </h6>
                                                                            </div>
                                                                            <p>{!! $reply->text !!}</p>
                                                                            <div class="faq-date">
                                                                                <em>{{ Hekmatinasser\Verta\Verta::instance($reply->created_at)->format('Y/n/j') }}</em>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- modal -->
    <div class="modal fade bd-example-modal-lg" id="comment-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">نظر خریدار</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('home.comments.store', ['product' => $product->id]) }}" method="POST"
                        id="addCommentForm">
                        @csrf
                        <section class="product-comment">
                            <div class="comments-product">
                                <div class="comments-product-row">
                                    <div class="col-lg-12 col-md-12 col-xs-12 pull-left">
                                        <div class="comments-product-col-info">
                                            <div class="comments-product-attributes px-3">
                                                <div class="row">
                                                    <div class="col-sm-12 col-12 mb-3">
                                                        <div class="comments-product-attributes-title">ارزش خرید نسبت به
                                                            قیمت
                                                        </div>
                                                        <input type="range" class="cost form-control-range"
                                                            name="cost" id="formControlRange" min="1"
                                                            max="5" step="1" onInput="setlable('cost')">
                                                    </div>
                                                    <center>
                                                        <span id="rangeva1" class="bg-primary text-white p-1"
                                                            style="border-radius: 1rem;">
                                                            خوب
                                                        </span>
                                                    </center>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-12 mb-3">
                                                        <div class="comments-product-attributes-title">کیفیت</div>
                                                        <input type="range" class="quality form-control-range"
                                                            name="quality" id="formControlRange" min="1"
                                                            max="5" step="1" onInput="setlable('quality')">
                                                    </div>
                                                    <center>
                                                        <span id="rangeva2" class="bg-primary text-white p-1"
                                                            style="border-radius: 1rem;">
                                                            خوب
                                                        </span>
                                                    </center>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-12 mb-3">
                                                        <div class="comments-product-attributes-title">میزان رضایت کلی
                                                            از
                                                            محصول
                                                        </div>
                                                        <input type="range" class="satisfaction form-control-range"
                                                            name="satisfaction" id="formControlRange" min="1"
                                                            max="5" step="1"
                                                            onInput="setlable('satisfaction')">
                                                    </div>
                                                    <center>
                                                        <span id="rangeva3" class="bg-primary text-white p-1"
                                                            style="border-radius: 1rem;">
                                                            خوب
                                                        </span>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comments-add">
                                        <div class="comments-add-row d-inline-block">
                                            <div class="col-lg-12 col-md-12 col-xs-12 pull-right">
                                                <div class="comments-add-col-form">
                                                    <div class="form-comment">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="form-ui">
                                                                <form class="px-5">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-row-title mb-2">عنوان نظر
                                                                                شما
                                                                                (اجباری)
                                                                            </div>
                                                                            <div class="form-row">
                                                                                <input class="input-ui pr-2"
                                                                                    type="text" name="title"
                                                                                    placeholder="عنوان نظر خود را بنویسید">
                                                                                @error('title')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 form-comment-title--positive mt-4">
                                                                            <div class="form-row-title mb-2 pr-3">
                                                                                نقاط قوت
                                                                            </div>
                                                                            <div id="advantages" class="form-row">
                                                                                <div class="ui-input--add-point">
                                                                                    <input name="strengthss[]"
                                                                                        class="input-ui pr-2 ui-input-field"
                                                                                        type="text"
                                                                                        id="advantage-input"
                                                                                        autocomplete="off" value="">
                                                                                    <button
                                                                                        class="ui-input-point js-icon-form-add"
                                                                                        type="button"></button>
                                                                                    @error('strengthss')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div
                                                                                    class="form-comment-dynamic-labels js-advantages-list">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-12 form-comment-title--negative mt-2">
                                                                            <div class="form-row-title mb-2 pr-3">
                                                                                نقاط ضعف
                                                                            </div>
                                                                            <div id="disadvantages" class="form-row">
                                                                                <div class="ui-input--add-point">
                                                                                    <input name="weak-points[]"
                                                                                        class="input-ui pr-2 ui-input-field"
                                                                                        type="text"
                                                                                        id="disadvantage-input"
                                                                                        autocomplete="off" value="">
                                                                                    <button
                                                                                        class="ui-input-point js-icon-form-add"
                                                                                        type="button"></button>
                                                                                    @error('weak-points')
                                                                                        <span
                                                                                            class="text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div
                                                                                    class="form-comment-dynamic-labels js-disadvantages-list">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 mt-3">
                                                                            <div class="form-row-title mb-2">متن نظر شما
                                                                                (اجباری)
                                                                            </div>
                                                                            <div class="form-row">
                                                                                <textarea class="input-ui pr-2 pt-2" name="text" rows="5" placeholder="متن خود را بنویسید"
                                                                                    style="height:120px;"></textarea>
                                                                                @error('text')
                                                                                    <span
                                                                                        class="text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <br>
                                                                        <br>
                                                                        <div class="col-12 mt-5 px-0">
                                                                            <button class="btn comment-submit-button">
                                                                                ثبت نظر
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @if (Session::get('status_show'))
        <script>
            $(function() {
                $('#comment-modal').modal('show');
            });
        </script>
    @endif
    <script type='application/ld+json'>



  {
"@context": "https://www.schema.org",
"@type": "Product",
"image": "{{url(env('PRODUCT_PRIMARY_IMAGES_UPLOAD_PATCH') . $product->primary_image)}}",
"name": "{!! $product->name !!}",
"description": "{!! $product->name !!}",
"brand": {
"@type": "Brand",
"name": "DiyarHonar"
},

"offers": {
"@type": "Offer",
"itemCondition": "https://schema.org/NewCondition",
"availability": "https://schema.org/InStock",
"price": "{{$product->price_check->price}}",
"priceCurrency": "IRR",
"priceValidUntil": "2024-11-20",
"shippingDetails": {
"@type": "OfferShippingDetails",
"shippingRate": {
"@type": "MonetaryAmount",
"value": "4.5",
"currency": "IRR"
},
"shippingDestination": {
"@type": "DefinedRegion",
"addressCountry": "IR"
},
"hasMerchantReturnPolicy": {
    "@type": "MerchantReturnPolicy",
    "returnFees": "Customer pays",
    "returnPolicyCountry": "IR"
},
"deliveryTime": {
"@type": "ShippingDeliveryTime",
"handlingTime": {
"@type": "QuantitativeValue",
"minValue": "0",
"maxValue": "1",
"unitCode": "DAY"
},
"transitTime": {
"@type": "QuantitativeValue",
"minValue": "1",
"maxValue": "5"
}
}
}
},
"review": {
"@type": "Review",
"reviewRating": {
"@type": "Rating",
"ratingValue": "4",
"bestRating": "5"
},
"author": {
"@type": "Person",
"name": "Hosein Ghasemi"
}
},
"aggregateRating": {
"@type": "AggregateRating",
"ratingValue": "4.4",
"reviewCount": "89"
}

}
 </script>
    <script>
        function setlable(e) {
            if (e == "cost") {
                var lable = $(".cost").val();
            }
            if (e == "quality") {
                var lable = $(".quality").val();
            }
            if (e == "satisfaction") {
                var lable = $(".satisfaction").val();
            }
            if (lable == 1) {
                lable = "بد";
            }
            if (lable == 2) {
                lable = "متوسط";
            }
            if (lable == 3) {
                lable = "خوب";
            }
            if (lable == 4) {
                lable = "خیلی خوب";
            }
            if (lable == 5) {
                lable = "عالی";
            }
            if (e == "cost") {
                $("#rangeva1").html(lable);
            }
            if (e == "quality") {
                $("#rangeva2").html(lable);
            }
            if (e == "satisfaction") {
                $("#rangeva3").html(lable);
            }
        }

        $(document).ready(function(e) {
            if (typeof $('#var-select').val() === 'undefined' || typeof $('#var-select').val() === null) {
                variation = null;
            } else {
                variation = JSON.parse($('#var-select').val());
            }
            let variationPriceDiv = $('.variation-price');
            variationPriceDiv.empty();
            if (variation == null) {
                let spanPrice = $('<span />', {

                    text: '-',
                });
                variationPriceDiv.append(spanPrice);
            } else {
                $('.sku').html(variation.sku);
                if (variation.time_guarantee === null) {
                    $('.guarantee1').remove();
                } else {
                    $('#time_guarantee').html(variation.time_guarantee);
                }
                if (variation.guarantee === null) {
                    $('.guarantee2').remove();
                } else {
                    $('#guarantee').html(variation.guarantee);
                }
                if (variation.is_sale) {
                    let spanSale = $('<div />', {
                        class: 'amount text-success ',
                        text: number_format(variation.sale_price) + ' تومان'
                    });
                    let spanPrice = $('<del />', {
                        class: 'amount text-danger',
                        text: number_format(variation.price) + ' تومان'
                    });
                    variationPriceDiv.append(spanSale);
                    variationPriceDiv.append(spanPrice);
                } else {
                    let spanPrice = $('<span />', {
                        class: 'amount',
                        text: number_format(variation.price) + ' تومان'
                    });
                    variationPriceDiv.append(spanPrice);
                }
                $('.numberstyle').attr('max', variation.quantity);
                $('.numberstyle').val(1);
            }
        });
        $('#var-select').on('change', function() {
            let variation = JSON.parse(this.value);
            let variationPriceDiv = $('.variation-price');
            variationPriceDiv.empty();
            $('.sku').html(variation.sku);
            $('#time_guarantee').html(variation.time_guarantee);
            $('#guarantee').html(variation.guarantee);
            if (variation.is_sale) {
                let spanSale = $('<div />', {
                    class: 'amount text-success',
                    text: number_format(variation.sale_price) + ' تومان'
                });
                let spanPrice = $('<del />', {
                    class: 'amount text-danger',
                    text: number_format(variation.price) + ' تومان'
                });
                variationPriceDiv.append(spanSale);
                variationPriceDiv.append(spanPrice);
            } else {
                let spanPrice = $('<span />', {
                    class: 'amount',
                    text: number_format(variation.price) + ' تومان'
                });
                variationPriceDiv.append(spanPrice);
            }
            $('.numberstyle').attr('max', variation.quantity);
            $('.numberstyle').val(1);
        });

        function reply(id) {
            let sid = 'reply-form-' + id;
            console.log(sid);
            $('#' + sid).toggle();
        }
    </script>
    <script>
        (function($) {
            $.fn.numberstyle = function(options) {
                /*
                 * Default settings
                 */
                var settings = $.extend({
                    value: 0,
                    step: undefined,
                    min: undefined,
                    max: undefined
                }, options);
                /*
                 * Init every element
                 */
                return this.each(function(i) {
                    /*
                     * Base options
                     */
                    var input = $(this);
                    /*
                     * Add new DOM
                     */
                    /*
                     * Attach events
                     */
                    // use .off() to prevent triggering twice
                    $(document).off('click', '.qty-btn').on('click', '.qty-btn', function(e) {
                        var input = $(this).siblings('input'),
                            sibBtn = $(this).siblings('.qty-btn'),
                            step = (settings.step) ? parseFloat(settings.step) : parseFloat(input
                                .attr(
                                    'step')),
                            min = (settings.min) ? settings.min : (input.attr('min')) ? input.attr(
                                'min') : undefined,
                            max = (settings.max) ? settings.max : (input.attr('max')) ? input.attr(
                                'max') : undefined,
                            oldValue = parseFloat(input.val()),
                            newVal; //Add value
                        if ($(this).hasClass('qty-add')) {
                            newVal = (oldValue >= max) ? oldValue : oldValue + step,
                                newVal = (newVal > max) ? max : newVal;
                            if (newVal == max) {
                                $(this).addClass('disabled');
                            }
                            sibBtn.removeClass('disabled'); //Remove value
                        } else {
                            newVal = (oldValue <= min) ? oldValue : oldValue - step,
                                newVal = (newVal < min) ? min : newVal;
                            if (newVal == min) {
                                $(this).addClass('disabled');
                            }
                            sibBtn.removeClass('disabled');
                        } //Update value
                        input.val(newVal).trigger('change');
                    });
                    input.on('change', function() {
                        const val = parseFloat(input.val()),
                            min = (settings.min) ? settings.min : (input.attr('min')) ? input.attr(
                                'min') : undefined,
                            max = (settings.max) ? settings.max : (input.attr('max')) ? input.attr(
                                'max') : undefined;
                        if (val > max) {
                            input.val(max);
                        }
                        if (val < min) {
                            input.val(min);
                        }
                    });
                });
            };
            $('.numberstyle').numberstyle();
        }(jQuery));
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/home/css/number.css') }}" />
    <style>
        .owl-carousel {
            touch-action: manipulation;
        }
    </style>
@endpush
