{{-- @if ($top_menue)
    <section class="h-main-row">
        <a href="#" class="mini-cart-item-image d-block">
            <img src="{{ url(env('BANNER_IMAGES_PATCH') . $top_menue->image) }}" height="60px" width="100%"
                alt="top-banner" style="object-fit: cover; object-position: center">
        </a>
    </section>
@endif
<!-- header-------------------------------->
<header class="header-main">
    <div class="container-main">
        <div class="d-block">
            <section class="h-main-row">
                <div class="col-lg-9 col-md-6 col-4 pr">
                    <div class="header-right">
                        <div class="col-lg-3 pr mt-1">
                            <div class="header-logo row text-right">
                                @isset($setting->logo)
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('storage/logo/' . $setting->logo) }}" alt="logo" />
                                    </a>
                                @endisset
                            </div>
                        </div>
                        <div class="col-lg-8 pr d-none d-lg-block mt-2">
                            <div class="header-search row text-right">
                                @livewire('home.sections.search-box')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-8 pr">
                    <div class="header-cart-nav header-main-nav pl mt-0">
                        @if (!request()->routeIs('home.cart.index'))
                            <li class="divider-space-card d-block">
                                <div class="header-cart-basket">
                                    <p class="cart-basket-box">
                                        <span class="icon-cart">
                                            <i class="fa fa-shopping-cart"></i>
                                        </span>
                                        <span class="count-cart"
                                            id="count-cart">{{ Cart::getContent()->count() }}</span>
                                    </p>
                                    <div class="widget-shopping-cart" id="widget-shopping-cart"
                                        style={{ \Cart::isEmpty() ? 'display:none' : '' }}>
                                        <div class="widget-shopping-cart-content">
                                            <div class="wrapper">
                                                <div class="scrollbar" id="style-1">
                                                    <div class="force-overflow">
                                                        <ul class="product-list-widget" id="product-list-widget">
                                                            @foreach (\Cart::getContent() as $item)
                                                                <li class="mini-cart-item" id="{{ $item->id }}">
                                                                    <div class="mini-cart-item-content">
                                                                        <a href="{{ route('home.products.show', ['product' => $item->associatedModel->slug]) }}"
                                                                            class="mini-cart-item-image d-block">
                                                                            <img
                                                                                src="{{ url(env('PRODUCT_PRIMARY_IMAGES_UPLOAD_PATCH') . $item->associatedModel->primary_image) }}">
                                                                        </a>
                                                                        <span
                                                                            class="product-name-card">{{ $item->name }}
                                                                            {{ $item->attributes->value }}</span>
                                                                        <a onclick="return delete_product_cart('{{ $item->id }}')"
                                                                            class="mr-3"
                                                                            style="position: absolute;left: 3px;">
                                                                            <i class="mdi mdi-close"
                                                                                id="del-pro-cart-{{ $item->id }}"></i>
                                                                        </a>
                                                                        <div class="variation">
                                                                            <span class="variation-n">فروشنده :
                                                                            </span>
                                                                            <p class="mb-0">فروشگاه دیار هنر</p>
                                                                        </div>
                                                                        <!-- <div
                                                                                class="header-basket-list-item-color-badge">
                                                                                رنگ:
                                                                                <span style="background: #000"></span>
                                                                            </div> -->
                                                                        <div class="quantity">
                                                                            <span class="quantity-Price-amount">
                                                                                <span>
                                                                                    <span>تومان</span>
                                                                                    {{ number_format($item->quantity * $item->price) }}
                                                                                </span>
                                                                                <span>
                                                                                    =
                                                                                    {{ number_format($item->price) }} *
                                                                                    {{ $item->quantity }}
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mini-card-total">
                                                <strong>قیمت کل : </strong>
                                                <span class="price-total"> {{ number_format(\Cart::getTotal()) }}
                                                    <span>تومان</span>
                                                </span>
                                            </div>
                                            <div class="mini-card-button">
                                                <a href="{{ route('home.cart.index') }}" class="view-card">مشاهده
                                                    سبد
                                                    خرید</a>
                                                <a href="{{ route('home.orders.checkout') }}"
                                                    class="card-checkout">تسویه
                                                    حساب</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </div>
                    @guest
                        @if (!request()->routeIs('login') && !request()->routeIs('register'))
                            <div class="account-box pl-1">
                                <div class="nav-account d-block pl" id="nav-cart-style">
                                    <a href="{{ route('login') }}" class="btn btn-secondary btn-sm " id="login-style"><i
                                            class="fa fa-sign-in" aria-hidden="true"></i> ثبت
                                        نام | ورود
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endguest
                    @auth
                        <div class="pl" id="nav-account-style-0">
                            <div class="header-left">
                                <div class="header-account text-left">
                                    <div class="d-block">
                                        <div class="account-box">
                                            <div class="nav-account d-block pl">
                                                <span class="icon-account">
                                                    <img src="/assets/home/images/header-user.png" class="avator"
                                                        alt="avator">
                                                </span>
                                                <span
                                                    class="title-account">{{ Auth::user()->name ?? auth()->user()->cellphone }}</span>
                                                <div class="dropdown-menu">
                                                    <ul class="account-uls mb-0">
                                                        @if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('Weblog'))
                                                            <li class="account-item">
                                                                <a href="{{ route('admin.home') }}"
                                                                    class="account-link">پنل ادمین</a>
                                                            </li>
                                                        @endif
                                                        <li class="account-item">
                                                            <a href="{{ route('home.user_profile') }}"
                                                                class="account-link">پنل
                                                                کاربری</a>
                                                        </li>
                                                        <li class="account-item">
                                                            <a href="{{ route('logout') }}" class="account-link"
                                                                onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                                                                rel="nofollow">خروج</a>
                                                            <form id="frm-logout" action="{{ route('logout') }}"
                                                                method="POST">
                                                                {{ csrf_field() }}
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </section>
            <nav class="header-main-nav">
                <div class="d-block">
                    <div class="align-items-center">
                        <ul class="menu-ul mega-menu-level-one">
                            @if ($categories->where('is_active', 1)->count() == 1)
                                @foreach ($categories->first()->children->sortBy('order')->where('is_active', 1) as $category2)
                                    <li id="nav-menu-item" class="menu-item nav-overlay">
                                        <a href="{{ $category2->children()->active()->exists()? route('home.products.search', $category2->slug): route('home.products.index', $category2->slug) }}"
                                            class="current-link-menu">
                                            {{ $category2->name }}
                                        </a>
                                        @if (count($category2->children->where('is_active', 1)))
                                            <ul class="sub-menu is-mega-menu-small">
                                                @foreach ($category2->children->sortBy('order')->where('is_active', 1) as $category3)
                                                    <li class="menu-mega-item menu-item-type-mega-menu item-small">
                                                        <a class="mega-menu-link"
                                                            href="{{ route('home.products.index', ['slug' => $category3->slug]) }}">
                                                            {{ $category3->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @elseif($categories->where('is_active', 1)->count() > 1)
                                <li id="nav-menu-item" class="menu-item nav-overlay pl-3">
                                    <a href="#" class="current-link-menu">
                                        <i class="fa fa-bars"></i> دسته بندی
                                    </a>
                                    <div class="is-mega-menu">
                                        <div class="d-flex p-2">
                                            <div class="main-cat">
                                                <ul class="">
                                                    @foreach ($categories->sortBy('order')->where('is_active', 1) as $category)
                                                        <li>
                                                            <a
                                                                onmouseover="showChildCategory(event,{{ $category->id }})">
                                                                @isset($category->icon)
                                                                    <i class="{{ $category->icon }}"></i>
                                                                @endisset {{ $category->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="child-cat">
                                                @foreach ($categories->sortBy('order')->where('is_active', 1) as $category1)
                                                    @if ($category1->children->where('is_active', 1)->count() > 0)
                                                        <ul class="sub-menu is-mega-menu mega-menu-level-two"
                                                            id="child-category-{{ $category1->id }}"
                                                            style="display: none">
                                                            @foreach ($category1->children->sortBy('order')->where('is_active', 1) as $category2)
                                                                <li class="menu-mega-item menu-item-type-mega-menu">
                                                                    <a href="{{ $category2->children()->active()->exists()? route('home.products.search', $category2->slug): route('home.products.index', $category2->slug) }}"
                                                                        class="mega-menu-link">
                                                                        {{ $category2->name }}
                                                                    </a>
                                                                    @if (count($category2->children->where('is_active', 1)))
                                                                        <ul class="sub-menu mega-menu-level-three">
                                                                            @foreach ($category2->children->sortBy('order')->where('is_active', 1) as $category3)
                                                                                <li class="menu-mega-item-three">
                                                                                    <a
                                                                                        href="{{ route('home.products.index', ['slug' => $category3->slug]) }}">
                                                                                        {{ $category3->name }}
                                                                                    </a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                            @if ($menue_banner)
                                                                <li
                                                                    class="menu-mega-item menu-item-type-mega-menu pr-2">
                                                                    <img src="{{ url(env('BANNER_IMAGES_PATCH') . $menue_banner->image) }}"
                                                                        alt="{{ $menue_banner->title }}">
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            <li class="menu-item">
                                <i class="fas fa-fire text-secondary"></i>
                                <a href="{{ route('home.products.search', ['label' => 'فروش ویژه']) }}"
                                    class="current-link-menu">فروش ویژه</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('home.products.search', ['label' => 'پیشنهاد ما']) }}"
                                    class="current-link-menu">پیشنهاد ما</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('home.posts.index') }}" class="current-link-menu">
                                    بلاگ
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('home.compare.index') }}" class="current-link-menu">مقایسه</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('contact-us') }}" class="current-link-menu">تماس با ما</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="mobile-search d-lg-none">
                    <button class="btn btn-sm  btn-outline-secondary text-right" data-toggle="modal"
                        data-target="#exampleModalCenter"><i class="fa fa-search"></i> جستجو
                    </button>
                </div>
            </nav>
            <!--    responsive-megamenu-mobile----------------->
            <nav class="sidebar">
                <div class="nav-header">
                    <div class="header-cover"></div>
                    <div class="logo-wrap">
                        @isset($setting->logo)
                            <a href="{{ route('home') }}" class="logo-icon">
                                <img src="{{ asset('storage/logo/' . $setting->logo) }}" alt="logo"
                                    width="40" />
                            </a>
                        @endisset
                    </div>
                </div>
                <!-- لیست دسته بندی ها در حالت موبایل در دو سطح -->
                <ul class="nav-categories ul-base mt-4">
                    @if (count($categories->where('is_active', 1)) == 1)
                        @foreach ($categories->first()->children->sortBy('order')->where('is_active', 1) as $category2)
                            <li>
                                <a href="#" class="collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapse-{{ $category2->id }}" aria-expanded="false"
                                    aria-controls="collapse-{{ $category2->id }}">
                                    @if (count($category2->children->where('is_active', 1)) > 0)
                                        <i class="mdi mdi-chevron-down"></i>
                                    @endif
                                    {{ $category2->name }}
                                </a>
                                <div id="collapse-{{ $category2->id }}" class="collapse"
                                    aria-labelledby="headingOne">
                                    <ul>
                                        <li>
                                            <a href="{{ route('home.products.search', ['slug' => $category2->slug]) }}"
                                                class="category-level-2">همه موارد این دسته</a>
                                        </li>
                                        @if (count($category2->children->where('is_active', 1)) > 0)
                                            @foreach ($category2->children->sortBy('order')->where('is_active', 1) as $category3)
                                                <li>
                                                    <a href="{{ route('home.products.search', ['slug' => $category3->slug]) }}"
                                                        class="category-level-2">{{ $category3->name }}</a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        @endforeach
                    @elseif(count($categories) > 1)
                        @foreach ($categories->sortBy('order')->where('is_active', 1) as $category1)
                            <li>
                                <a href="#" class="collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapse-{{ $category1->id }}" aria-expanded="false"
                                    aria-controls="collapse-{{ $category1->id }}">
                                    @if (count($category1->children->where('is_active', 1)) > 0)
                                        <i class="mdi mdi-chevron-down"></i>
                                    @endif
                                    {{ $category1->name }}
                                </a>
                                @if (count($category1->children->where('is_active', 1)) > 0)
                                    <div id="collapse-{{ $category1->id }}" class="collapse"
                                        aria-labelledby="headingOne">
                                        <ul>
                                            @foreach ($category1->children->sortBy('order')->where('is_active', 1) as $category2)
                                                <li @class(['has-sub' => count($category2->children) > 0])><a
                                                        href="{{ route('home.products.search', ['slug' => $category2->slug]) }}"
                                                        class="category-level-2">{{ $category2->name }}</a>
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('home.products.search', ['slug' => $category2->slug]) }}"
                                                                class="category-level-3">همه موارد این دسته</a>
                                                        </li>
                                                        @if (count($category2->children->where('is_active', 1)) > 0)
                                                            @foreach ($category2->children->sortBy('order')->where('is_active', 1) as $category3)
                                                                <li>
                                                                    <a href="{{ route('home.products.index', ['slug' => $category3->slug]) }}"
                                                                        class="category-level-3">{{ $category3->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    @endif
                    <li>
                        <a href="{{ route('home.products.search', ['label' => 'فروش ویژه']) }}"
                            class="current-link-menu">فروش ویژه</a>
                    </li>
                    <li>
                        <a href="{{ route('home.products.search', ['label' => 'پیشنهاد ما']) }}"
                            class="current-link-menu">پیشنهاد ما</a>
                    </li>
                    <li>
                        <a href="{{ route('home.posts.index') }}">بلاگ</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('home.compare.index') }}" class="current-link-menu">مقایسه</a>
                    </li>
                    <li>
                        <a href="{{ route('contact-us') }}">تماس با ما</a>
                    </li>
                </ul>
                <!-- پایان لیست دسته بندی ها در حالت موبایل در دو سطح  -->
            </nav>
            <div class="nav-btn nav-slider">
                <span class="linee1"></span>
                <span class="linee2"></span>
                <span class="linee3"></span>
            </div>
            <div class="overlay"></div>
            <!-- bottom-menu-joomy -->
            <div class="bottom-menu-joomy mx-auto active-progress">
                <ul class="m-1">
                    <li class="m-1">
                        <a href="{{ route('home') }}">
                            <i class="fa fa-home"></i>
                            صفحه اصلی
                        </a>
                    </li>
                    <li class="m-1">
                        <a href="{{ route('home.profile.wishlist.index') }}" class="cart-basket-box">
                            <i class="fa fa-heart">
                            </i>
                            لیست علاقه مندی ها
                        </a>
                    </li>
                    <li class="m-1">
                        <a href="{{ route('home.cart.index') }}">
                            <i class="fa fa-shopping-cart"></i>
                            سبد خرید
                            <div class="shopping-bag-item" id="shopping-bag-item">{{ Cart::getContent()->count() }}
                            </div>
                        </a>
                    </li>
                    <li class="m-1">
                        <a href="#" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fa fa-search"></i>
                            جستجو
                        </a>
                    </li>
                    <li class="m-1">
                        @auth
                            <a onclick="openAccountSidebar()" href="#" rel="nofollow">
                                <i class="fa fa-user"></i>
                                منو کاربری
                            </a>
                        @endauth
                        @guest
                            <a href="{{ route('login') }}">
                                <i class="fa fa-user"></i>
                                ورود/ثبت نام
                            </a>
                        @endguest
                    </li>

                </ul>
            </div>
            <!--    responsive-megamenu-mobile----------------->
        </div>
    </div>
</header>
@auth()
    <!-- mobile account sidebar -->
    <div class="sidebar account-sidebar p-2">
        <div class="post-item-profile">
            <div class="sidebar-profile sidebar-navigation">
                <button class="sidebar-close mr-auto" onclick="closeAccountSidebar(event)"><span
                        aria-hidden="true">X</span></button>
                <section class="profile-box">
                    <header class="profile-box-header-inline mb-0">
                        <div class="profile-avatar user-avatar profile-img">
                            <img src="/assets/home/images/user.png" alt="profile">
                        </div>
                    </header>
                    <footer class="profile-box-content-footer">
                        <span class="profile-box-nameuser">{{ Auth::user()->name ?? auth()->user()->cellphone }}</span>
                        <ul class="profile-account-navs">
                            <li class="profile-account-nav-item navigation-link-dashboard">
                                <a href="{{ route('home.user_profile') }}" @class(['active' => request()->routeIs('home.user_profile')])><i
                                        class="mdi mdi-account-outline"></i>
                                    پروفایل
                                </a>
                            </li>
                            <li class="profile-account-nav-item navigation-link-dashboard">
                                <a href="{{ route('home.user_profile.ordersList') }}" @class([
                                    'active' => request()->routeIs('home.user_profile.ordersList'),
                                ])><i
                                        class="mdi mdi-cart"></i>
                                    همه سفارش ها
                                </a>
                            </li>
                            <li class="profile-account-nav-item navigation-link-dashboard">
                                <a href="{{ route('home.profile.wishlist.index') }}" @class([
                                    'active' => request()->routeIs('home.profile.wishlist.index'),
                                ])><i
                                        class="mdi mdi-heart"></i>
                                    لیست علاقه مندی
                                </a>
                            </li>
                            <li class="profile-account-nav-item navigation-link-dashboard">
                                <a href="{{ route('home.addreses.index') }}" @class(['active' => request()->routeIs('home.addreses.index')])><i
                                        class="mdi mdi-map-outline"></i>
                                    آدرس ها
                                </a>
                            </li>
                            <li class="profile-account-nav-item navigation-link-dashboard">
                                <a href="{{ route('home.user_profile.commentsList') }}" @class([
                                    'active' => request()->routeIs('home.user_profile.commentsList'),
                                ])><i
                                        class="mdi mdi-email-open-outline"></i>
                                    نظرات
                                </a>
                            </li>
                            <li class="profile-account-nav-item navigation-link-dashboard">
                                <a href="{{ route('home.compare.index') }}" @class(['active' => request()->routeIs('home.compare.index')])><i
                                        class="mdi mdi-compare"></i>
                                    لیست مقایسه
                                </a>
                            </li>
                            <li class="profile-account-nav-item navigation-link-dashboard">
                                <a href="{{ route('home.user_profile.edit') }}" @class(['active' => request()->routeIs('home.user_profile.edit')])><i
                                        class="mdi mdi-tooltip-text-outline"></i>
                                    اطلاعات حساب
                                </a>
                            </li>
                        </ul>
                        <div class="profile-box-tabs">
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                                rel="nofollow" class="profile-box-tab-sign-out"><i
                                    class="mdi mdi-logout-variant"></i>خروج از حساب</a>
                            <form id="frm-logout" action="{{ route('logout') }}" method="POST">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </footer>
                </section>
            </div>
        </div>

    </div>
    <div onclick="closeAccountSidebar(event)" class="account-sidebar-overlay d-none"></div>
    <!-- end mobile account sidebar -->
@endauth
@push('scripts')
    <script>
        let activeChildBox

        function openAccountSidebar() {
            $('.account-sidebar').addClass('open')
            $('.account-sidebar-overlay').removeClass('d-none');
        }

        function closeAccountSidebar(event) {
            $('.account-sidebar').removeClass('open')
            $('.account-sidebar-overlay').addClass('d-none');
        }

        function showChildCategory(event, id) {
            if (activeChildBox != null) {
                $('#child-category-' + activeChildBox).hide();
            }
            $('.main-cat a').removeClass('active-main-cat');
            $('#child-category-' + id).show()
            $(event.currentTarget).addClass('active-main-cat');
            activeChildBox = id;
        }
    </script>
@endpush --}}
