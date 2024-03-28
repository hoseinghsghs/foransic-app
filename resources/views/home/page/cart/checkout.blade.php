@extends('home.layout.MasterHome')
@section('title', 'پرداخت ')
@section('content')
    <!-- checkout------------------------------>
    <div class="container-main">
        <div class="d-block">
            <div class="col-12">
                <section class="blog-checkout d-block order-1">
                    <div class="checkout woocommerce-checkout">
                        <div class="content-checkout">
                            <div class="middle-container">
                                <form class="form form-checkout" id="checkout" action="{{ route('home.payment') }}"
                                    method="POST">
                                    @csrf
                                    <div class="col2-set" id="customer-details">
                                        <div class="billing-fields">
                                            <h4>جزئیات صورتحساب</h4>
                                            <div class="form-checkout-row">
                                                <div class="Order-another-shipping-address mt-2 mb-2">
                                                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                                        <label>انتخاب آدرس</label>
                                                        <select class="form-control form-control-md mb-0 text-center"
                                                            name="address_id" id="address-option">
                                                            <option value="new">آدرس جدید</option>
                                                            @if ($addresses->count() > 0)
                                                                @foreach ($addresses as $address)
                                                                    <option value="{{ $address->id }}">
                                                                        {{ $address->title }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('address_id')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    @if ($addresses->count() > 0)
                                                        @foreach ($addresses as $address)
                                                            <div id="dchange">
                                                                <div class="row mx-0 Order-another-shipping-address mt-2 checkout-address"
                                                                    style="display: none" id="{{ $address->id }}">
                                                                    <div class="col-12">
                                                                        <img src={{ asset('assets/home/images/icons/map.png') }}
                                                                            height="50px" alt="map" class="m-2 mr-4">
                                                                        <strong>مرحله اول : مشخصات و آدرس</strong>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="box-header">
                                                                            <span class="box-title">اطلاعات آدرس</span>
                                                                        </div>
                                                                        <table class="table table-borderless">
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <th scope="row">عنوان:</th>
                                                                                    <td>
                                                                                        <span class="amount">
                                                                                            {{ $address->title }}
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">نام تحویل گیرنده:
                                                                                    </th>
                                                                                    <td>
                                                                                        <span class="amount">
                                                                                            {{ $address->name }}
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">استان:</th>
                                                                                    <td>
                                                                                        <span class="amount">
                                                                                            {{ province_name($address->province_id) }}
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">شهر:</th>
                                                                                    <td>
                                                                                        <span class="amount">
                                                                                            {{ city_name($address->city_id) }}
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">تلفن همراه:</th>
                                                                                    <td>
                                                                                        <span class="amount">
                                                                                            {{ $address->cellphone }}
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">تلفن ثابت:</th>
                                                                                    <td>
                                                                                        <span class="amount">
                                                                                            {{ $address->cellphone2 }}
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">کد پستی:</th>
                                                                                    <td>
                                                                                        <span class="amount">
                                                                                            {{ $address->postal_code }}
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                            </tfoot>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="h-50">
                                                                            <div class="box-header mb-1">
                                                                                <span class="box-title">آدرس اصلی</span>
                                                                            </div>
                                                                            {{ $address->address }}
                                                                        </div>
                                                                        <div class="h-50">
                                                                            <div class="box-header mb-1">
                                                                                <span class="box-title">آدرس جایگزین</span>
                                                                            </div>
                                                                            {{ $address->lastaddress }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12 col-12 mt-3 mb-4">
                                                                        <a href="{{ route('home.addreses.edit', ['address' => $address->id]) }}"
                                                                            class="edit-address-link btn-Order btn liko-danger-btn btn btn-sm">ویرایش
                                                                            آدرس</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    <!-- new address form -->

                                                    <div class="shipping-address checkout-address mx-2" id="new-address">
                                                        <img src={{ asset('assets/home/images/icons/map.png') }}
                                                            height="50px" alt="map" class="m-2 mr-4">
                                                        <strong>مرحله اول : مشخصات و آدرس</strong>
                                                        <div class="middle-container">
                                                            <form class="form-checkout">
                                                                <div class="row form-checkout-row">
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                                                        <label for="name">عنوان آدرس<abbr
                                                                                class="required text-danger"
                                                                                title="ضروری">*</abbr></span>
                                                                        </label>
                                                                        <input type="text" id="name" name="title"
                                                                            value="{{ old('title') }}"
                                                                            class="input-name-checkout form-control @error('title') is-invalid @enderror m-0">
                                                                        @error('title')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                                                        <label for="name">نام و نام خانوادگی تحویل
                                                                            گیرنده <abbr text-danger
                                                                                class="required text-danger"
                                                                                title="ضروری">*</abbr></span>
                                                                        </label>
                                                                        <input type="text" id="name" name="name"
                                                                            value="{{ old('name') }}"
                                                                            class="input-name-checkout form-control @error('name') is-invalid @enderror m-0">
                                                                        @error('name')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                                                        <label for="phone-number">شماره موبایل <abbr
                                                                                class="text-danger required"
                                                                                title="ضروری">*</abbr></label>
                                                                        <input type="number" dir="ltr"
                                                                            id="phone-number" name="cellphone"
                                                                            value="{{ old('cellphone') }}"
                                                                            class="input-name-checkout form-control m-0 text-center @error('cellphone') is-invalid @enderror">
                                                                        @error('cellphone')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                                                        <label for="fixed-number"> تلفن ثابت
                                                                            <abbr class="required text-danger"
                                                                                title="ضروری">*</abbr></label>
                                                                        <input type="number" dir="ltr"
                                                                            id="fixed-number"
                                                                            placeholder="تلفن ثابت با پیش شماره استان"
                                                                            name="cellphone2"
                                                                            value="{{ old('cellphone2') }}"
                                                                            class="input-name-checkout form-control m-0 text-center @error('cellphone2') is-invalid @enderror">
                                                                        @error('cellphone2')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                                                        <div class="form-checkout-valid-row">
                                                                            <label for="province">استان
                                                                                <abbr class="required text-danger"
                                                                                    title="ضروری">*</abbr>
                                                                            </label>
                                                                            <select id="province_id" name="province_id"
                                                                                class="form-control m-0 province-select @error('province_id') is-invalid @enderror">
                                                                                <option selected="selected" disabled>
                                                                                    استان
                                                                                    مورد
                                                                                    نظر خود را انتخاب کنید
                                                                                </option>
                                                                                @foreach ($provinces as $province)
                                                                                    <option value="{{ $province->id }}">
                                                                                        {{ $province->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('province_id')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                                                        <div class="form-checkout-valid-row">
                                                                            <label for="city">شهر
                                                                                <abbr class="required text-danger"
                                                                                    title="ضروری">*</abbr></label>
                                                                            <select name="city_id" id="city"
                                                                                class="city-select form-control m-0 @error('city_id') is-invalid @enderror">
                                                                            </select>
                                                                            @error('city_id')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                                                        <div class="form-checkout-valid-row">
                                                                            <label for="apt-id">واحد</label>
                                                                            <input type="text" id="apt-id"
                                                                                name="unit"
                                                                                value="{{ old('unit') }}"
                                                                                class="input-name-checkout js-input-apt-id form-control m-0 @error('unit') is-invalid @enderror">
                                                                            @error('unit')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-3">
                                                                        <label for="post-code">کد پستی<abbr
                                                                                class="required text-danger"
                                                                                title="ضروری">*</abbr></label>
                                                                        <input type="number" dir="ltr"
                                                                            id="post-code" name="postal_code"
                                                                            class="input-name-checkout form-control m-0 text-center @error('postal_code') is-invalid @enderror"
                                                                            value="{{ old('postal_code') }}"
                                                                            placeholder="کدپستی را بدون خط تیره وارد کنید">
                                                                        @error('postal_code')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-6 col-12 mb-3">
                                                                        <label for="address">آدرس
                                                                            <abbr class="required text-danger"
                                                                                title="ضروری">*</abbr>
                                                                        </label>
                                                                        <textarea rows="5" cols="30" id="address" name="address"
                                                                            class="textarea-name-checkout form-control m-0 @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                                                        @error('address')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-6 col-12 mb-3">
                                                                        <label for="address">آدرس جایگزین</label>
                                                                        <textarea rows="5" cols="30" id="address" name="lastaddress"
                                                                            class="textarea-name-checkout form-control mb-0 @error('lastaddress') is-invalid @enderror"
                                                                            placeholder="آدرس جایگزین در صورت ضرورت...">{{ old('lastaddress') }}</textarea>
                                                                        @error('lastaddress')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-12 col-12 mb-3">
                                                                        <label for="description">توضیحات سفارش
                                                                            <span class="optional">(اختیاری)</span>
                                                                        </label>
                                                                        <textarea id="description" rows="5" cols="30" name="description"
                                                                            class="textarea-name-checkout form-control mb-0 @error('description') is-invalid @enderror"
                                                                            style="border-radius: 1rem;" value="{{ old('description') }}" placeholder="توضیحات ضروری دریافت محصول">{{ old('description') }}</textarea>
                                                                        @error('description')
                                                                            <span
                                                                                class="text-danger mb-2">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row shipping-method my-3 mx-1">
                                                <div class="col-12 m-1">
                                                    <img src={{ asset('assets/home/images/icons/send.png') }}
                                                        height="70px" alt="map">
                                                    <strong>مرحله دوم : روش ارسال</strong>
                                                    <abbr class="required text-danger" title="ضروری">*</abbr>

                                                </div>
                                                <div
                                                    class="shipping-address mt-2 mb-2 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">

                                                    <ul class="checkout-payment-methods">
                                                        <li
                                                            class="checkout-payment-method-item d-block m-3 border-for-cheack">
                                                            <label for="post" class="outline-radio">
                                                                <input form="checkout" type="radio"
                                                                    name="transport_method" value="post" id="post"
                                                                    checked>
                                                                <span class="outline-radio-check"></span>
                                                            </label>
                                                            <label for="post" class="shipping-totals-title-row">
                                                                <img src={{ asset('assets/home/images/send/03.png') }}
                                                                    height="40px" width="80px" />
                                                                <p class="d-inline text-center">
                                                                    پست پیشتاز
                                                                </p>
                                                            </label>
                                                        </li>
                                                        <li
                                                            class="checkout-payment-method-item d-block m-3 border-for-cheack">
                                                            <label for="bus" class="outline-radio">
                                                                <input form="checkout" type="radio"
                                                                    name="transport_method" value="bus"
                                                                    id="bus">
                                                                <span class="outline-radio-check"></span>
                                                            </label>
                                                            <label for="bus" class="shipping-totals-title-row">
                                                                <img src={{ asset('assets/home/images/send/01.png') }}
                                                                    height="40px" width="80px" />
                                                                <p class="d-inline text-center">
                                                                    حمل با اتوبوس
                                                                </p>
                                                            </label>
                                                        </li>

                                                        <li class="checkout-payment-method-item d-block m-3">
                                                            <label for="delivery" class="outline-radio">
                                                                <input form="checkout" type="radio"
                                                                    name="transport_method" value="delivery"
                                                                    id="delivery">
                                                                <span class="outline-radio-check"></span>
                                                            </label>
                                                            <label for="delivery" class="shipping-totals-title-row">
                                                                <img src={{ asset('assets/home/images/send/02.png') }}
                                                                    height="40px" width="80px" />
                                                                <p class="d-inline text-center">
                                                                    پیک موتوری
                                                                </p>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div
                                                    class="shipping-address mt-2 mb-2 col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                                                    <p class="checkout-payment-method-item d-block m-3 ">
                                                        <strong>
                                                            کاربران گرامی توجه داشته باشند که:
                                                        </strong>

                                                        </br>
                                                        1- پیک موتوری فقط مربوط به شهرستان اصفهان است.
                                                        </br>
                                                        2- هزینه حمل با اتوبوس و پیک موتوری پس پرداخت است.
                                                        </br>

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="checkout-review-order">
                                    <div class="row d-flex justify-content-center shipping-method my-3 mx-1">

                                        <strong class="col-12 mt-3 mb-1">
                                            <img src={{ asset('assets/home/images/icons/pay.png') }} height="70px"
                                                alt="map">
                                            مرحله سوم : صورتحساب و انتخاب
                                            درگاه پرداخت</strong>

                                        <div class="col-lg-5 mx-2 tree-steps mb-5 revieworder-2">
                                            <table class="checkout-review-order-table table table-borderless  mb-3 mt-2">
                                                <thead>
                                                    <tr class="border-bottom border-info">
                                                        <th scope="col" class="product-name p-1">تصویر</th>
                                                        <th scope="col" class="product-name p-1">محصول</th>
                                                        <th scope="col" class="product-price p-1">قیمت کل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (\Cart::getContent() as $item)
                                                        <tr class="checkout-cart-item">

                                                            <td class="product-name p-1 pt-4">
                                                                <a
                                                                    href={{ route('home.products.show', ['product' => $item->associatedModel->slug]) }}>
                                                                    <img src={{ asset('storage/small_primary_image/' . $item->associatedModel->small_primary_image) }}
                                                                        alt={{ $item->name }} width="48"
                                                                        class="img-fluid rounded"
                                                                        style="min-height: 3rem;">
                                                                </a>
                                                            </td>
                                                            <td class="product-name p-1 pt-4">
                                                                <span>{{ $item->name }}</span>
                                                                <span>
                                                                    <span class="text-info">
                                                                        ({{ $item->quantity }}
                                                                        عدد)
                                                                    </span>
                                                                </span>
                                                            </td>
                                                            <td class="product-price text-info p-1 pt-4">
                                                                <span
                                                                    class="amount">{{ number_format($item->price * $item->quantity) }}
                                                                    <span>تومان</span>
                                                                </span>
                                                                @if ($item->attributes->is_sale)
                                                                    <span style="font-size: 12px ; color:red">
                                                                        ({{ $item->attributes->percent_sale }}%
                                                                        تخفیف)
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <table
                                                class="checkout-review-order-table table table-borderless revieworder-3 mb-3">
                                                <tfoot>
                                                    <tr class="cart-subtotal">
                                                        <th class="font-weight-bold p-2">مجموع</th>
                                                        <td class="p-2">
                                                            <span
                                                                class="amount font-weight-bold">{{ number_format(\Cart::getTotal() + cartTotalSaleAmount()) }}
                                                                <span class="amount font-weight-bold">تومان</span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th class="font-weight-bold p-2">حمل ونقل</th>
                                                        <td class="p-2">
                                                            <div class="shipping-totals-item">
                                                                <span>
                                                                    @if (cartTotalDeliveryAmount('post') == 0)
                                                                        <span style="color: #31ab00"
                                                                            id="transport-changer"
                                                                            class="font-weight-bold">
                                                                            رایگان
                                                                        </span>
                                                                    @else
                                                                        <span class="font-weight-bold"
                                                                            id="transport-changer">
                                                                            {{ number_format(cartTotalDeliveryAmount('post')) }}
                                                                            تومان
                                                                        </span>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    @if (number_format(cartTotalSaleAmount()))
                                                        <tr class="cart-discount">
                                                            <th class="font-weight-bold p-2">تخفیف شما از این خرید</th>
                                                            <td data-title=" تخفیف شما از این خرید " class="p-2">
                                                                <div class="price">
                                                                    {{ number_format(cartTotalSaleAmount()) }}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    <tr class="cart-discount">
                                                        <th class="font-weight-bold p-2">مبلغ کسر شده کد تخفیف</th>
                                                        <td data-title="مبلغ کسر شده کد تخفیف" class="p-2">
                                                            <div class="price">
                                                                <span class="inc-coupon text-success">
                                                                    {{ number_format(session()->get('coupon.amount')) }}
                                                                    تومان
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="cart-discount">
                                                        <th class="p-2"><strong>مبلغ قابل پرداخت</strong></th>
                                                        <td data-title="مبلغ قابل پرداخت" class="p-2">
                                                            <div class="price">
                                                                <strong id="final-amounts">
                                                                    {{ number_format(cartTotalAmount('post')) }}
                                                                    تومان
                                                                </strong>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-lg-5 mx-2 tree-steps mb-5 revieworder-2">
                                            @if (!session()->has('coupon'))
                                                <div class="content-checkout" id="coupon-box">
                                                    <div class="notices-wrapper">
                                                        <div class="form-coupon-toggle">
                                                            <div class="info">
                                                                کد تخفیف دارید؟
                                                                <a href="javascript:void(0);" class="showcoupon">برای
                                                                    نوشتن کد
                                                                    اینجا کلیک کنید</a>
                                                            </div>
                                                            <div class="checkout-coupon">
                                                                <p class="mr-4">اگر کد تخفیف دارید، لطفا وارد کنید.</p>
                                                                <form class="form-coupon col-md-7 col-sm-6">
                                                                    <div class="form-row d-flex">
                                                                        <input type="text" name="coupon-code"
                                                                            class="checkout-discount-code"
                                                                            placeholder="کد تخفیف">
                                                                        <div class="append pl">
                                                                            <button
                                                                                class="btn-append btn btn-info bg-info border-info"
                                                                                type="submit">اعمال
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <h5 class="my-3"> انتخاب درگاه پرداخت</h5>
                                            <ul class="checkout-payment-methods">
                                                <li class="checkout-payment-method-item d-block">
                                                    <label for="mellat" class="outline-radio">
                                                        <input form="checkout" type="radio" name="payment_method"
                                                               value="mellat" id="mellat" checked>
                                                        <span class="outline-radio-check"></span>
                                                    </label>
                                                    <label for="mellat" class="shipping-totals-title-row">
                                                        <img src={{ asset('assets/home/images/paying/mellat.png') }}
                                                            height="70px" width="70px" />
                                                    </label>
                                                </li>
                                                <li class="checkout-payment-method-item d-block">
                                                    <label for="zarinpal" class="outline-radio">
                                                        <input form="checkout" type="radio" name="payment_method"
                                                            value="zarinpal" id="zarinpal">
                                                        <span class="outline-radio-check"></span>
                                                    </label>
                                                    <label for="zarinpal" class="shipping-totals-title-row">
                                                        <img src={{ asset('assets/home/images/paying/zarin.png') }}
                                                            width="90px" />
                                                    </label>
                                                </li>
                                            </ul>
                                            <div class="form-auth-row">
                                                <label for="#" class="ui-checkbox mt-1">
                                                    <input type="checkbox" value="1"
                                                        oninvalid="this.setCustomValidity('تیک قوانین و حریم خصوصی را پس از مطالعه بزنید')"
                                                        oninput="this.setCustomValidity('')" required form="checkout"
                                                        id="remember">
                                                    <span class="ui-checkbox-check"></span>
                                                </label>
                                                <label for="remember" class="remember-me mr-0"><a
                                                        href="{{ route('privacy') }}">حریم خصوصی</a> و
                                                    <a href="{{ route('ruls') }}">شرایط قوانین </a>استفاده از سرویس های
                                                    سایت
                                                    را
                                                    مطالعه نموده و با کلیه موارد آن موافقم <abbr
                                                        class="required text-danger" title="ضروری">*</abbr></label>
                                            </div>
                                            <button form="checkout" class="btn-Order btn btn-primary mt-4 mb-3"
                                                type="submit"><i
                                                    class="fa fa-shopping-cart fa-flip-horizontal fa-lg"></i>
                                                پرداخت
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- checkout------------------------------>
@endsection
@push('scripts')
    <script>
        var previous;
        $('#address-option').on('focus', function() {

            previous = $(this).val();
        }).change(function() {

            let categoryId = $(this).val();

            if (categoryId == "new") {
                $('#new-address').show();
            } else {
                $('#new-address').hide();
            }

            $("#" + previous + "").hide();
            $("#" + categoryId + "").show();

            Swal.fire({
                text: 'آدرس ارسال محصول تغییر کرد',
                icon: "success",
                timer: 1500,
                confirmButtonText: 'تایید',
                timerProgressBar: true
            });
        })

        $('.province-select').change(function() {

            var provinceID = $(this).val();
            if (provinceID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/get-province-cities-list') }}?province_id=" + provinceID,
                    success: function(res) {
                        if (res) {
                            $(".city-select").empty();

                            $.each(res, function(key, city) {
                                $(".city-select").append('<option value="' + city.id + '">' +
                                    city.name + '</option>');
                            });
                        } else {
                            $(".city-select").empty();
                        }
                    }
                });
            } else {
                $(".city-select").empty();
            }
        });

        $('#address-checkout').click(function() {
            $('#address-form').toggle();

        })

        $(document).ready(function(e) {
            if ($('#zarinpal').hasClass('collapse')) {
                $('#pay-methode').val('zarinpal');
            }
            if ($('#paypal-1').hasClass('collapse')) {
                $('#pay-methode').val('pay');
            }

            let categoryId = $('#address-option').val();
            if (categoryId == "new") {

                $('#sub-address').show();
            } else {
                $('#sub-address').hide();
            }
        })

        $('#zarinpal').click(function() {
            $('#pay-methode').val('zarinpal');
        })

        $('#paypal-1').click(function() {
            $('#pay-methode').val('pay');
        })
    </script>
    <script>
        $('input[type=radio][name=transport_method]').change(function() {
            let url = window.location.origin + "/change-transport";
            let type = $('input[name="transport_method"]:checked').val();
            $.post(
                url, {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    transport: type,
                },
                function(response, status, xhr) {
                    $('#final-amounts').html(number_format(response.paying_amount) + " تومان ");
                });
            if (this.value == 'bus' || this.value == 'delivery') {
                $('#transport-changer').html("پس پرداخت");
                {{-- $('#final-amounts').html("{{ number_format(cartTotalAmount('bus')) }} تومان"); --}}

            } else if (this.value == 'post') {
                $('#transport-changer').html("{{ number_format(cartTotalDeliveryAmount('post')) }} تومان");
                {{-- $('#final-amounts').html("{{ number_format(cartTotalAmount('post')) }} تومان"); --}}
            }
        });

        function transpot() {
            return $('input[name="name_of_your_radiobutton"]:checked').val();
        }
    </script>
@endpush
