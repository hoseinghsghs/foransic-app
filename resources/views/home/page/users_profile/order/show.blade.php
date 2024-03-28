@extends('home.layout.MasterHome')
@section('title', 'سفارشات')
@section('content')
    <div class="container-main">
        <div class="d-block">
            <section class="profile-home">
                <div class="col-lg">
                    <div class="post-item-profile order-1 d-block">
                        @include('home.page.users_profile.partial.right_side')
                        <div class="col-lg-9 col-12 pl content-pro pt-2">
                            <a class="btn btn-secondary btn-sm text-white" onclick="printDiv()"><i class="fa fa-print"></i> چاپ
                                سفارش</a>
                            <div class="table-order-view row">
                                @if (URL::previous() != route('home.user_profile.ordersList'))
                                    <div class="col-12 mt-2">
                                        @if ($order->status == 'آماده برای ارسال')
                                            <div class="alert alert-success m-0" role="alert">
                                                <p>
                                                    پرداخت با موفقیت انجام شد. سفارش شما با موفقیت ثبت شد و در زمان
                                                    تعیین
                                                    شده
                                                    برای
                                                    شما
                                                    ارسال خواهد شد. از اینکه {{ env('APP_NAME') }} را برای خرید انتخاب
                                                    کردید
                                                    از
                                                    شما
                                                    سپاسگزاریم.</p>
                                            </div>
                                        @endif
                                        @if ($order->status == 'پرداخت نشده')
                                            <div class="alert alert-danger m-0" role="alert">
                                                <p>
                                                    سفارش دریافت نشد
                                                    پرداخت ناموفق. برای جلوگیری از لغو سیستمی سفارش،تا 24 ساعت آینده
                                                    پرداخت را انجام دهید. چنانچه طی این فرایند مبلغی از حساب شما کسر شده
                                                    است،طی
                                                    72 ساعت آینده به حساب شما باز خواهد گشت.
                                                </p>
                                                <p>
                                                    کد سفارش برای پیگیری : {{ $order->id }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <div class="col-lg-6 col-12 mt-3 ">
                                    <div class="profile-content">
                                        <div class="profile-stats">
                                            <div class="box-header">
                                                <span class="box-title">جزئیات سفارش محصول</span>
                                            </div>
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">تصویر</th>
                                                        <th scope="col">نام محصول</th>
                                                        <th scope="col">جمع</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->orderItems as $item)
                                                        <tr>
                                                            <td class="product-name">
                                                                <a
                                                                    href="{{ route('home.products.show', ['product' => $item->product->slug]) }}">
                                                                    <img src="{{ asset('storage/primary_image/' . $item->product->primary_image) }}"
                                                                        alt="{{ $item->product->name }}" width="48"
                                                                        class="img-fluid rounded" style="min-height: 3rem;">
                                                                </a>
                                                            </td>
                                                            <td class="product-name">
                                                                <a style="color: #17a2b8"
                                                                    href="{{ route('home.products.show', ['product' => $item->product->slug]) }}">
                                                                    ({{ $item->product->name }})
                                                                    </br>
                                                                    <span class="text-muted">
                                                                        {{ $item->quantity }} عدد
                                                                        * {{ number_format($item->price) }} تومان
                                                                    </span>
                                                                </a>
                                                            </td>
                                                            <td class="product-total">
                                                                <span class="amount">
                                                                    <span>تومان</span>
                                                                    {{ number_format($item->subtotal) }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="profile-content mt-3">
                                        <div class="profile-stats p-3">
                                            <div class="box-header">
                                                <span class="box-title">جمع هزینه و تخفیف</span>
                                            </div>
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">مجموع:</th>
                                                        <td>
                                                            <span class="amount">
                                                                {{ number_format($order->total_amount) }}
                                                                <span>تومان</span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">حمل و نقل:</th>
                                                        <td>{{ number_format($order->delivery_amount) }}
                                                            <span>تومان</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">نوع ارسال: </th>
                                                        <td>
                                                            @if ($order->transport_method == 'post')
                                                                ارسال پستی
                                                            @elseif ($order->transport_method == 'bus')
                                                                ارسال با اتوبوس
                                                            @elseif ($order->transport_method == 'delivery')
                                                                ارسال با پیک
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">کد تخفیف:</th>
                                                        <td>{{ number_format($order->coupon_amount) }}
                                                            <span>تومان</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">شماره تراکنش:</th>
                                                        <td>{{ $order->transaction->ref_id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">قیمت نهایی:</th>
                                                        <td>
                                                            <span class="amount">
                                                                {{ number_format($order->paying_amount) }}
                                                                <span>تومان</span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="col-lg-6 col-12 mt-3 ">
                                    <div class="profile-content">
                                        <div class="profile-stats p-3">
                                            <div class="box-header">
                                                <span class="box-title">آدرس ارسال محصول</span>
                                            </div>
                                            <table class="table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">عنوان:</th>
                                                        <td>
                                                            <span class="amount"> {{ $order->address->title }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">نام تحویل گیرنده:</th>
                                                        <td>
                                                            <span class="amount"> {{ $order->address->name }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            روش پرداخت:
                                                        </th>
                                                        <td>{{ $order->payment_type }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">استان:</th>
                                                        <td>
                                                            <span class="amount">
                                                                {{ province_name($order->address->province_id) }} </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">شهر:</th>
                                                        <td>
                                                            <span class="amount">
                                                                {{ city_name($order->address->city_id) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">استان:</th>
                                                        <td>
                                                            <span class="amount">
                                                                {{ province_name($order->address->province_id) }} </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"> شماره 1:</th>
                                                        <td>
                                                            <span class="amount">
                                                                {{ $order->address->cellphone }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"> شماره 2:</th>
                                                        <td>
                                                            <span class="amount">
                                                                {{ $order->address->cellphone2 }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"> کد پستی:</th>
                                                        <td>
                                                            <span class="amount">
                                                                {{ $order->address->postal_code }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="col-lg-12 col-12 mt-3 ">
                                    <div class="profile-content">
                                        <div class="profile-stats p-3">
                                            <div class="box-header">
                                                <span class="box-title">آدرس اصلی</span>
                                            </div>
                                            <tr>
                                                <td>{{ $order->address->address }}
                                                </td>
                                            </tr>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12 mt-3 mb-4">
                                    <div class="profile-content">
                                        <div class="profile-stats p-3">
                                            <div class="box-header">
                                                <span class="box-title">آدرس جایگزین</span>
                                            </div>
                                            {{ $order->address->lastaddress }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div><!-- فاکتور -->
    <div class="container-xl mt-4" style="margin-top: 100px; display:none ">
        <div class="row mt-4">
            <div class="col-3 text-center"><img src="{{ asset('storage/logo/' . $setting->logo) }}" alt="logo"
                    height="45px" /></div>
            <div class="col-6 text-center">
                <h5 class="font-weight-bold">صورتحساب فروش </h5>
            </div>
            <div class="col-3 text-right">
                <h6>شماره سفارش: {{ $order->id }}</h6>
                <h6>تاریخ سفارش: {{ Hekmatinasser\Verta\Verta::instance($order->created_at)->format('Y/n/j') }}</h6>
            </div>
        </div>
        <div class="row m-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" colspan="11">مشخصات فروشنده</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="11" class="text-right">
                            <div class="row">
                                <div class="col-8">
                                    <p>نام شخص حقیق / حقوقی:{{ env('APP_NAME') }}</p>
                                    <p>آدرس کامل: اصفهان خیابان پروین خیابان شیخ طوسی شرقی کوچه شماره 30 پلاک 22
                                    </p>
                                </div>
                                <div class="col-4">
                                    <p>کد پستی :</p>
                                    <p>8199864544</p>
                                </div>
                                <div class="col-4">
                                    <p>تلفن / نمابر: 09139035692,09162418808</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th class="text-center" colspan="11">مشخصات خریدار</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="11" class="text-right">
                            <div class="row">
                                <div class="col-4">
                                    <p>نام شخص حقیق / حقوقی: {{ $order->address->name }}</p>
                                    <p>آدرس کامل:{{ province_name($order->address->province_id) }}، شهر
                                        {{ city_name($order->address->city_id) }}، {{ $order->address->address }}
                                    </p>
                                </div>
                                <div class="col-4">
                                    <p>کد پستی:{{ $order->address->postal_code }}</p>
                                </div>
                                <div class="col-4">
                                    <p>تلفن / نمابر:{{ $order->address->cellphone }} , {{ $order->address->cellphone2 }}
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th class="text-center" colspan="11">مشخصات کالا یا خدمات مورد معامله</th>
                    </tr>
                </thead>
                <thead>
                    <tr class="text-center">
                        <th>ردیف</th>
                        <th>کد کالا</th>
                        <th>شرح کالا یا خدمات</th>
                        <th>تعداد / مقدار</th>
                        <th>واحد انداز گیری</th>
                        <th>مبلغ واحد (تومان)</th>
                        <th>مبلغ کل (تومان)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        @php
                            $sku = App\Models\ProductVariation::find($item->product_variation_id);
                        @endphp
                        <tr class="text-center">
                            <td>۱</td>
                            <td>{{ $sku->sku }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>عدد</td>
                            <td class="text-center">{{ number_format($item->price) }}</td>
                            <td class="text-center">{{ number_format($item->subtotal) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="6" class="text-center">جمع کل</th>
                        <th class="text-center" colspan="2">{{ number_format($order->total_amount) }}</th>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-center">هزینه ارسال</th>
                        <th class="text-center" colspan="2">{{ number_format($order->delivery_amount) }}</th>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-center">کد تخفیف</th>
                        <th class="text-center" colspan="2">{{ number_format($order->coupon_amount) }}</th>
                    </tr>
                    <tr>
                        <th colspan="6" class="text-center">مبلغ قابل پرداخت</th>
                        <th class="text-center" colspan="2">{{ number_format($order->paying_amount) }}</th>
                    </tr>
                    <tr>
                        <th colspan="5" class="text-right">شرایط و نحوه فروش: {{ $order->payment_type }} </th>
                        <th colspan="6" class="text-right">توضیحات: {{ $order->description }} </th>
                    </tr>
                    <tr style="padding: 60px 0;">
                        <td colspan="5" class="text-right">مهر و امضا فروشنده</td>
                        <td colspan="6" class="text-right">مهر و امضا خریدار</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @push('scripts')
        <script>
            function printDiv() {
                var divContents = $(".container-xl").html();
                let url = window.location.origin + "/css/home.css";
                var a = window.open('', '', 'height=768px, width=1366px');
                a.document.write('<html><body style="background-color: white !important">');
                a.document.write('<head><title></title>');
                a.document.write('<link rel="stylesheet" href="' + url + '" type="text/css" />');
                a.document.write('</head>');
                a.document.write(divContents);
                a.document.write('</body></html>');
                a.document.close();
                a.focus();
                setTimeout(function() {
                    a.print();
                }, 1000);
                return true;
            }
        </script>
    @endpush
@endsection
