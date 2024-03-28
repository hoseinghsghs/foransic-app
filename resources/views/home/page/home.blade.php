@extends('home.layout.MasterHome')
@section('title', 'فروشگاه صنایع دستی دیار هنر')

@section('content')
    @include('home.partial.SliderMain')
    @includeWhen($headers->count() > 0, 'home.partial.Adplacement')

    <!-- slidre-product------------------------>
    <!-- فروش ویژه -->
    @if ($Products_special->count())
        <section class="section-slider amazing-section pt-0">
            <div class="container-amazing col-12">
                <div class="col-lg-3 display-md-none pull-right">
                    <div class="amazing-product text-center">
                        <a href="#">
                            <img src="{{ asset('assets/home/images/slider-amazing/am-01.png') }}" alt="special">
                        </a>
                        </br>
                        <a href="{{ route('home.products.search', ['label' => 'فروش ویژه']) }}"
                            class="title-one text-white ">مشاهده همه <i class="fa fa-angle-left"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 pull-left pr-1">
                    <div class="slider-widget-products mb-0">
                        <div class="widget widget-product card" style="padding:10px ;">
                            <header class="card-header">
                                <span class="title-one">فروش ویژه</span>
                                <a href="{{ route('home.products.search', ['label' => 'فروش ویژه']) }}"
                                    class="card-title">مشاهده همه <i class="fa fa-angle-left"></i></a>
                            </header>
                            <div class="product-carousel productcar owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 827px;">
                                        @each('home.components.ProductCart2', $Products_special, 'Product_special')
                                    </div>
                                </div>
                                <div class="owl-nav">
                                </div>
                                <div class="owl-dots disabled"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--  پایان محصولات ویژه -->
    <!-- پیشنهاد ما -->
    <div class="container-main container-xlg">
        <div class="d-block">
            @if ($Products_our_suggestion->count())
                <div
                    class="{{ $Products_our_suggestion_units->count() ? 'col-lg-9 col-md-9 col-xs-12 pr order-1 d-block' : 'col-lg-12 col-md-12 col-xs-12 pr order-1 d-block' }}">
                    <div class="slider-widget-products">
                        <div class="widget widget-product card">
                            <header class="card-header">
                                <span class="title-one">پیشنهاد ما</span>
                                <a href="{{ route('home.products.search', ['label' => 'پیشنهاد ما']) }}"><span
                                        class="title-one-0 pl">مشاهده همه <i class="fa fa-angle-left"></i></span></a>
                            </header>
                            <div class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
                                        @each('home.components.ProductCart1', $Products_our_suggestion, 'Product_special')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- پایان پیشنهاد ما -->
            <input type="hidden" value="1" id="qtybutton">
            <!-- slider-moment پیشنهاد لحظه ای------------------------->
            @if ($Products_our_suggestion_units->count())
                <div class="col-lg-3 col-md-3 col-xs-12 pl order-1 d-block">
                    <div class="slider-moments">
                        <div class="widget-suggestion widget card">
                            <header class="card-header promo-single-headline">
                                <h3 class="card-title float-none">پیشنهاد لحظه‌ای</h3>
                            </header>
                            <div id="suggestion-slider" class="owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(1369px, 0px, 0px); transition: all 0.25s ease 0s; width: 2190px;">
                                        @each('home.components.ProductSuggestion', $Products_our_suggestion_units, 'Products_our_suggestion_unit')
                                    </div>
                                </div>
                            </div>
                            <div id="progressBar">
                                <div class="slide-progress" style="width: 100%; transition: width 5000ms ease 0s;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- پایان پیشنهاد لحظه ای -->
            <!-- slider-product------------------------------->
            @foreach ($products_is_show as $product_is_show)
                @if ($loop->index == 1)
                    <div class="container-main">
                        <div class="adplacement-container-row">
                            @foreach ($centers as $center)
                                <div class="col-12 col-lg-6 col-md-6 pr ">
                                    <a href="{{ $center->button_link }}" class="adplacement-item">
                                        <div class="adplacement-sponsored_box">
                                            <img src="{{ url(env('BANNER_IMAGES_PATCH') . $center->image) }}"
                                                alt="{{ $loop->index }} - بنر محصول منتخب">
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="col-lg-12 col-md-12 col-xs-12 pr order-1 d-block">
                    <div class="slider-widget-products">
                        <div class="widget widget-product card">
                            <header class="card-header">
                                <strong style="font-size: 1rem; display: contents" class="title-one">
                                    {{ $product_is_show->name }}</strong>
                                <a href="{{ route('home.products.index', $product_is_show->slug) }}"><span
                                        class="title-one-0 pl">مشاهده
                                        همه <i class="fa fa-angle-left"></i></span></a>
                            </header>
                            <div class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
                                        @each(
                                            'home.components.ProductCart1',
                                            $product_is_show->products->where('is_active', 1)->shuffle()->take(8),
                                            'Product_special'
                                        )
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- slider-product end------------------------------->
            @if (isset($main_post))
                <aside class="main-row-bg d-block d-md-block">
                    <div class="bg-cover"></div>
                    <div class="container-main">
                        <div class="d-block">
                            <section class="content-title section-title mt-5">
                                <div class="align-items-center">
                                    <div class="col-auto">
                                        <div class="title">
                                            <h1>{!! $main_post->title !!}</h1>
                                        </div>
                                        <div class="title">
                                            <h2 style="
    line-height: 2.2rem;
    font-size: 1rem;
    color: #fff;
">
                                                فروشگاه آنلاین صنایع دستی</h2>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="mb-3">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 pt-4 pl">
                                    <div class="card-product-horizontal">
                                        <div class="card-product-horizontal-img">
                                            <a href="#" class="d-block">
                                                <img src="{{ url('storage/' . $main_post->image->url) }}"
                                                    alt="{{ $main_post->title }}" style="border-radius: 1rem">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 pt-4 pr">
                                    <div class="card-product-horizontal">

                                        <div class="card-product-horizontal-content pr">
                                            <div class="card-product-horizontal-content-title">

                                            </div>
                                            <div class="card-product-horizontal-content-price"
                                                style="background-color: #0000004a;padding: 1rem; border-radius: 1rem;">
                                                <span class="text-light">
                                                    {!! $main_post->body !!}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            @endif
            {{-- news --}}
            @if (count($posts) === 0)
            @else
                <div class="widget widget-product card">
                    <header class="card-header" style="border-bottom: 2px solid #0099b5 !important;">
                        <span class="title-one">نوشته ها</span>
                        <a href="{{ route('home.posts.index') }}"><span class="title-one-0 pl">مشاهده
                                همه <i class="fa fa-angle-left"></i></span></a>
                    </header>
                    <div class="elementor">
                        @foreach ($posts as $post)
                            {{-- starat Introduction --}}

                            {{-- <div class="col-12 col-md-3 col-lg-4 col-xl-3 items-1 pr p-2">
                                یشی
                            </div> --}}
                            {{-- end Introduction --}}

                            <div class="col-12 col-md-3 col-lg-4 col-xl-3 items-1 pr p-2">
                                <article class="blog-item slider-widget-products">
                                    <figure class="figure">
                                        <div class="post-thumbnail">
                                            <img src="{{ url('storage/' . $post->image->url) }}"
                                                alt="{{ $post->title }}" height="420px" width="660px">
                                        </div>

                                        <div class="post-title">
                                            <a href="{{ route('home.posts.show', ['post' => $post->slug]) }}"
                                                class="d-block">
                                                <h4>{{ $post->title }}</h4>
                                            </a>
                                            <p> {{ Hekmatinasser\Verta\Verta::instance($post->created_at)->format('Y/n/j') }}
                                            </p>
                                            <a href="{{ route('home.posts.show', ['post' => $post->slug]) }}"
                                                type="button" class="btn btn-light btn-see-all">مشاهده</a>
                                        </div>
                                    </figure>
                                </article>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endif
            {{-- end news --}}

            {{-- clip --}}
            @if (count($posts) === 0)
            @else
                <div class="widget widget-product card">
                    <header class="card-header" style="border-bottom: 2px solid #0099b5 !important;">
                        <span class="title-one">معرفی محصول</span>

                    </header>
                    <div class="elementor">

                        <div class="col-12 col-md-6 col-lg-6 col-xl-6 items-1 pr p-2">
                            <article class="blog-item slider-widget-products">
                                <figure>
                                    <div>
                                        <div id="55680344284">
                                            <script type="text/JavaScript" src="https://www.aparat.com/embed/0tESX?data[rnddiv]=55680344284&data[responsive]=yes">
                                            </script>
                                        </div>
                                    </div>
                                </figure>
                            </article>
                        </div>

                        <div class="col-12 col-md-6 col-lg-6 col-xl-6 items-1 pr p-2">
                            <article class="blog-item slider-widget-products">
                                <figure>
                                    <div>
                                        <div id="55680344284">
                                            <div id="40363917011">
                                                <script type="text/JavaScript" src="https://www.aparat.com/embed/HP5zl?data[rnddiv]=40363917011&data[responsive]=yes">
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </figure>
                            </article>
                        </div>

                    </div>
                </div>
            @endif
            {{-- end clip --}}

            <!-- brand--------------------------------------->
            @if ($brands->count())
                <div class="col-lg-12 col-md-12 col-xs-12 pr order-1 d-block">
                    <div class="slider-widget-products">
                        <div class="widget widget-product card mb-0">
                            <div class="product-carousel-brand owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage"
                                        style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
                                        @foreach ($brands as $brand)
                                            <div class="owl-item active" style="width: 190.75px; margin-left: 10px;">
                                                <div class="item">
                                                    <a href="{{ $brand->link }}" class="d-block hover-img-link">
                                                        <img src="{{ url(env('BRAND_IMAGES_PATCH') . $brand->image) }}"
                                                            class="img-fluid img-brand" alt="{{ $brand->slug }}">
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- brand end----------------------------------------->
        </div>
    </div>
    <!-- footer------------------------------------------->

    @push('styles')
        <style>
            .owl-carousel {
                touch-action: manipulation;
            }
        </style>
    @endpush
    @push('scripts')
        <script type="application/ld+json" defer>
                {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "DiyarHonar",
    "image": "https://www.diyarhonar.ir/storage/logo/140212191923492506.png",
    "@id": "https://www.diyarhonar.ir",
    "url": "https://www.diyarhonar.ir",
    "telephone": "+989162418808",
    "priceRange": "IRR",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "اصفهان - خیابان پروین",
        "addressLocality": "اصفهان",
        "addressCountry": "IR"
    },
    "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Saturday",
            "Sunday"
        ],
        "opens": "09:00",
        "closes": "17:00"
    },
    "sameAs": "https://www.instagram.com/diyarhonar"
}
            </script>
    @endpush

@endsection
