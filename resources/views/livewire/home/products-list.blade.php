<div class="container-main">
    <div class="d-block">
        <div class="page-content page-row">
            <div class="main-row">
                <div id="breadcrumb">
                    <i class="mdi mdi-home"></i>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">خانه</a></li>
                            <li class="breadcrumb-item"><a href="{{route('home.products.search')}}">فروشگاه</a></li>
                            @if ($category)
                                @foreach($nav_categories as $nav_category)
                                    @if($loop->last)
                                        <li class="breadcrumb-item">
                                            @if ($filterd['search'] || $filterd['tag'])
                                                <a href="{{route('home.products.search',$nav_category['slug'])}}">{{$nav_category['name']}}</a>
                                            @else
                                                {{$nav_category['name']}}
                                            @endif
                                        </li>
                                    @else
                                        <li class="breadcrumb-item">
                                            <a href="{{route('home.products.search',$nav_category['slug'])}}">{{$nav_category['name']}}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                            @if ($filterd['search'])
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{'جستجوی: "'.$filterd['search'].'"'}}
                                </li>
                            @elseif ($filterd['tag'])
                                <li class="breadcrumb-item active" aria-current="page">تگ:
                                    {{$filterd['tag']}}
                                </li>
                            @endif
                        </ol>
                    </nav>
                </div>
                <!-- start sidebar--------------------->
                <div class="col-md-3 d-none d-md-block pr sticky-sidebar">
                    <div class="shop-archive-sidebar">
                        <div class="sidebar-archive">
                            <section class="widget-product-categories">
                                <header class="cat-header">
                                    <h2 class="mb-0">
                                        <button class="btn btn-block text-right" data-toggle="collapse"
                                                href="#headingOne" role="button" aria-expanded="false"
                                                aria-controls="headingOne">
                                            @if($routeName == 'home.products.index')
                                                {{$category->parent->name}}
                                            @elseif ($routeName == 'home.products.search' && isset($category))
                                                {{$category->name}}
                                            @else
                                                دسته بندی ها
                                            @endif
                                            <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                    </h2>
                                </header>
                                <div class="product-filter">
                                    <div class="card">
                                        <div class="collapse show" id="headingOne">
                                            <div class="card-main mb-0">
                                                @if($routeName == 'home.products.index')
                                                    @foreach ($category->parent->children->where('is_active',1) as $child)
                                                        <a href="{{$child->children()->active()->exists() ? route('home.products.search',$child->slug) : route('home.products.index',$child->slug)}}">
                                                            <h3 class="form-auth-row">
                                                                @if($child->id == $category->id)
                                                                    <label for="#" class="ui-checkbox">
                                                                        <input checked type="checkbox" disabled
                                                                               id="check-{{$loop->index}}">
                                                                        <span class="ui-checkbox-check"></span>
                                                                    </label>
                                                                    <span>{{$child->name}}</span>
                                                                @else
                                                                    <span
                                                                        style="cursor: pointer;">{{$child->name}}</span>
                                                                @endif
                                                            </h3>
                                                        </a>
                                                    @endforeach
                                                @elseif ($routeName == 'home.products.search' && isset($category))
                                                    @foreach ($category->children->where('is_active',1)  as $child)
                                                        <a href="{{$child->children()->active()->exists() ? route('home.products.search',$child->slug) : route('home.products.index',$child->slug)}}">
                                                            <h3 class="form-auth-row">
                                                                <label for="#" class="ui-checkbox">
                                                                    <input type="checkbox" id="check-{{$loop->index}}"
                                                                           disabled>
                                                                    <span class="ui-checkbox-check"></span>
                                                                </label>
                                                                <span style="cursor: pointer;">{{$child->name}}</span>
                                                            </h3>
                                                        </a>
                                                    @endforeach
                                                @else
                                                    @foreach ($categories as $main_category)
                                                        <a href="{{route('home.products.search',['slug'=>$main_category->slug])}}">
                                                            <h3 class="form-auth-row">
                                                                <label for="#" class="ui-checkbox">
                                                                    <input type="checkbox" id="check-{{$loop->index}}"
                                                                           disabled>
                                                                    <span class="ui-checkbox-check"></span>
                                                                </label>
                                                                <span
                                                                    style="cursor: pointer;">{{$main_category->name}}</span>
                                                            </h3>
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="widget-product-categories">
                                <header class="cat-header">
                                    <button class="btn btn-block text-right" data-toggle="collapse"
                                            href="#headingThree" role="button" aria-expanded="false"
                                            aria-controls="headingThree">
                                        محدوده قیمت
                                        <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                </header>
                                <div class="product-filter">
                                    <div class="card">
                                        <div class="collapse show" id="headingThree">
                                            <div class="card-main mb-0">
                                                <div class="box-data">
                                                    <div class="mt-5 mb-4">
                                                        <div wire:ignore id="slider-non-linear-step"></div>
                                                    </div>
                                                    <div class="filter-range mt-2 mb-2 pr">
                                                        <span>قیمت: </span>
                                                        {{number_format($filterd['price']['low'])}} -
                                                        {{number_format($filterd['price']['high'])}} تومان
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            @isset($attributes)
                                <!-- filter between attributes -->
                                @foreach ($attributes as $attribute)
                                    <section class="widget-product-categories" wire:key="attr-{{$attribute->id}}">
                                        <header class="cat-header">
                                            <button class="btn btn-block text-right" data-toggle="collapse"
                                                    href="#attribute-{{$attribute->id}}" role="button"
                                                    aria-expanded="false"
                                                    aria-controls="attribute-{{$attribute->id}}">
                                                {{$attribute->name}}
                                                <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                        </header>
                                        <div class="product-filter">
                                            <div class="card">
                                                <div class="collapse" id="attribute-{{$attribute->id}}"
                                                     wire:ignore.self>
                                                    <div class="card-main mb-0">
                                                        @foreach ($attribute->categoryValues as $value)
                                                            <div class="form-auth-row"
                                                                 wire:key="attr-{{$attribute->id}}-{{$loop->index}}">
                                                                <label for="#" class="ui-checkbox">
                                                                    <input id="attr-{{$attribute->id}}-{{$loop->index}}"
                                                                           @checked(array_key_exists($attribute->id,$filterd['attribute'])
                                                                       &&
                                                                       in_array($value->value,$filterd['attribute'][$attribute->id]))
                                                                           wire:click="addFilter('attribute','{{$attribute->id}}','{{$value->value}}')"
                                                                           type="checkbox" value="1">
                                                                    <span class="ui-checkbox-check"></span>
                                                                </label>
                                                                <label for="attr-{{$attribute->id}}-{{$loop->index}}"
                                                                       class="remember-me">{{$value->value}}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                @endforeach
                            @endisset

                            @if(isset($variation) && count($variation->variationValues) > 0)
                                <!-- filter between variation -->
                                <section class="widget-product-categories">
                                    <header class="cat-header">
                                        <button class="btn btn-block text-right" data-toggle="collapse"
                                                href="#variation-{{$variation->id}}" role="button"
                                                aria-expanded="false"
                                                aria-controls="variation-{{$variation->id}}">
                                            {{$variation->name}}
                                            <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                    </header>
                                    <div class="product-filter">
                                        <div class="card">
                                            <div class="collapse" id="variation-{{$variation->id}}" wire:ignore.self>
                                                <div class="card-main mb-0">
                                                    @foreach ($variation->variationValues as $value)
                                                        <div class="form-auth-row" wire:key="var-{{$loop->index}}">
                                                            <label for="#" class="ui-checkbox">
                                                                <input id="var-{{$loop->index}}"
                                                                       @checked(array_key_exists($variation->id,$filterd['variation'])
                                                                   &&
                                                                   in_array($value->value,$filterd['variation'][$variation->id]))
                                                                       wire:click="addFilter('variation','{{$variation->id}}','{{$value->value}}')"

                                                                       type="checkbox" value="1">
                                                                <span class="ui-checkbox-check"></span>
                                                            </label>
                                                            <label for="var-{{$loop->index}}"
                                                                   class="remember-me">{{$value->value}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-xs-12 pl">
                    <div class="shop-archive-content d-block">
                        <div class="archive-header d-flex flex-wrap align-items-center">
                            <h1 class="archive-header-title ml-sm-auto mb-md-0">
                                @if($filterd['search'])
                                    {{'نتیجه جستجوی: "'.$filterd['search'].'"'}}
                                @elseif($filterd['tag'])
                                    <i class="fa fa-hashtag"></i> {{$filterd['tag']}}
                                @elseif ($category)
                                    {{$category->name}}
                                @else
                                    محصولات
                                @endif
                            </h1>
                            <button class="btn mb-1 mb-md-0 ml-2 products-filter-btn d-md-none btn-sm"
                                    onclick="openSidebar(event)">
                                <i class="fas fa-filter"></i> فیلتر
                            </button>
                            @if ($initialFilter !== $filterd)
                                <div class="ml-2 mb-1 mb-md-0">
                                    <button class="btn btn-range" wire:click="resetFilters()">
                                        X حذف فیلترها
                                    </button>
                                </div>
                            @endif
                            <div class="d-flex align-items-center mb-1 mb-md-0">
                                <div class="sort-tabs mt-0 d-inline-block">
                                    <i class="fas fa-sort-amount-down"></i>
                                </div>
                                <div class="nav-sort-tabs-res ml-3 mr-1">
                                    <select class="custom-select custom-select-sm" wire:model="filterd.orderBy">
                                        <option value="default">پیش فرض</option>
                                        <option value="date-old">قدیمی ترین</option>
                                        <option value="date-new">جدیدترین</option>
                                        <option value="price-low">قیمت: کم به زیاد</option>
                                        <option value="price-high">قیمت: زیاد به کم</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-1 mb-md-0">
                                <div class="sort-tabs mt-0 d-inline-block">
                                    <i class="fas fa-th"></i>
                                </div>
                                <div class="nav-sort-tabs-res mr-1">
                                    <select class="custom-select custom-select-sm" wire:model="filterd.displayCount">
                                        <option value=12>نمایش 12</option>
                                        <option value=16>نمایش 16</option>
                                        <option value=24>نمایش 24</option>
                                        <option value=36>نمایش 36</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="product-items">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="Most-visited" role="tabpanel"
                                     aria-labelledby="Most-visited-tab">
                                    <div class="row m-0">
                                        @each('home.components.ProductCart3',$products,'product','home.partial.empty-products-list')
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="pagination-product">
                            {{$products->onEachSide(1)->links()}}
                        </div>
                        <div class="loader" wire:loading.flex wire:target="filterd,addFilter">
                            درحال بارگذاری ...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile product filter sidebar -->
    <div id="filter-sidebar" class="sidebar bg-light p-2" wire:ignore.self>
        <div class="shop-archive-sidebar">
            <div class="pl-2 pb-2">
                <button class="sidebar-close mr-auto" onclick="closeSidebar(event)"><span
                        aria-hidden="true">X</span></button>
            </div>
            <div class="sidebar-archive mb-3">
                <section class="widget-product-categories">
                    <header class="cat-header">
                        <h2 class="mb-0">
                            <button class="btn btn-block text-right" data-toggle="collapse" href="#headingOne"
                                    role="button" aria-expanded="false" aria-controls="headingOne">
                                @if($routeName == 'home.products.index')
                                    {{$category->parent->name}}
                                @elseif ($routeName == 'home.products.search' && isset($category))
                                    {{$category->name}}
                                @else
                                    دسته بندی ها
                                @endif
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                        </h2>
                    </header>
                    <div class="product-filter">
                        <div class="card">
                            <div class="collapse show" id="headingOne">
                                <div class="card-main mb-0">
                                    @if($routeName == 'home.products.index')
                                        @foreach ($category->parent->children as $child)
                                            <a href="{{$child->children()->active()->exists() ? route('home.products.search',$child->slug):route('home.products.index',$child->slug)}}">
                                                <h3 class="form-auth-row">
                                                    @if($child->id == $category->id)
                                                        <label for="#" class="ui-checkbox">
                                                            <input checked type="checkbox" disabled
                                                                   id="check-{{$loop->index}}">
                                                            <span class="ui-checkbox-check"></span>
                                                        </label>
                                                        <span>{{$child->name}}</span>
                                                    @else
                                                        <label for="check-{{$loop->index}}" class="ui-checkbox">
                                                            <input type="checkbox" disabled
                                                                   id="check-{{$loop->index}}">
                                                            <span class="ui-checkbox-check"></span>
                                                        </label>
                                                        <span style="cursor: pointer;">{{$child->name}}</span>
                                                    @endif
                                                </h3>
                                            </a>
                                        @endforeach
                                    @elseif ($routeName == 'home.products.search' && isset($category))
                                        @foreach ($category->children as $child)
                                            <a href="{{$child->children()->active()->exists() ? route('home.products.search',$child->slug):route('home.products.index',$child->slug)}}">
                                                <h3 class="form-auth-row">
                                                    <label for="#" class="ui-checkbox">
                                                        <input type="checkbox" id="check-{{$loop->index}}">
                                                        <span class="ui-checkbox-check"></span>
                                                    </label>
                                                    <span style="cursor: pointer;">{{$child->name}}</span>
                                                </h3>
                                            </a>
                                        @endforeach
                                    @else
                                        @foreach ($categories as $main_category)
                                            <a href="{{route('home.products.search',['slug'=>$main_category->slug])}}">
                                                <h3 class="form-auth-row">
                                                    <label for="#" class="ui-checkbox">
                                                        <input type="checkbox" id="check-{{$loop->index}}">
                                                        <span class="ui-checkbox-check"></span>
                                                    </label>
                                                    <span style="cursor: pointer;">{{$main_category->name}}</span>
                                                </h3>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="widget-product-categories">
                    <header class="cat-header">
                        <button class="btn btn-block text-right" data-toggle="collapse" href="#headingThree"
                                role="button" aria-expanded="false" aria-controls="headingThree">
                            محدوده قیمت
                            <i class="mdi mdi-chevron-down"></i>
                        </button>
                    </header>
                    <div class="product-filter">
                        <div class="card">
                            <div class="collapse show" id="headingThree">
                                <div class="card-main mb-0">
                                    <div class="box-data">
                                        <div class="mt-5 mb-4">
                                            <div wire:ignore id="slider-non-linear-step2"></div>
                                        </div>
                                        <div class="filter-range mt-2 mb-2 pr">
                                            <span>قیمت: </span>
                                            {{number_format($filterd['price']['low'])}} -
                                            {{number_format($filterd['price']['high'])}} تومان
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @isset($attributes)
                    <!-- filter between attributes -->
                    @foreach ($attributes as $attribute)
                        <section class="widget-product-categories" wire:key="attr-side-{{$attribute->id}}">
                            <header class="cat-header">
                                <button class="btn btn-block text-right" data-toggle="collapse"
                                        href="#attribute-side-{{$attribute->id}}" role="button"
                                        aria-expanded="false"
                                        aria-controls="attribute-side-{{$attribute->id}}">
                                    {{$attribute->name}}
                                    <i class="mdi mdi-chevron-down"></i>
                                </button>
                            </header>
                            <div class="product-filter">
                                <div class="card">
                                    <div class="collapse" id="attribute-side-{{$attribute->id}}" wire:ignore.self>
                                        <div class="card-main mb-0">
                                            @foreach ($attribute->categoryValues as $key=>$value)
                                                <div class="form-auth-row"
                                                     wire:key="attr-side-{{$attribute->id}}-{{$loop->index}}">
                                                    <label for="#" class="ui-checkbox">
                                                        <input id="attr-side-{{$attribute->id}}-{{$loop->index}}"
                                                               @checked(array_key_exists($attribute->id,$filterd['attribute']) &&
                                                           in_array($value->value,$filterd['attribute'][$attribute->id]))
                                                               wire:click="addFilter('attribute','{{$attribute->id}}','{{$value->value}}')"
                                                               type="checkbox" value="1">
                                                        <span class="ui-checkbox-check"></span>
                                                    </label>
                                                    <label for="attr-side-{{$attribute->id}}-{{$loop->index}}"
                                                           class="remember-me">{{$value->value}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endforeach
                @endisset

                @if(isset($variation) && count($variation->variationValues) > 0)
                    <!-- filter between variation -->
                    <section class="widget-product-categories">
                        <header class="cat-header">
                            <button class="btn btn-block text-right" data-toggle="collapse"
                                    href="#variation-side-{{$variation->id}}" role="button" aria-expanded="false"
                                    aria-controls="variation-side-{{$variation->id}}">
                                {{$variation->name}}
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                        </header>
                        <div class="product-filter">
                            <div class="card">
                                <div class="collapse" id="variation-side-{{$variation->id}}" wire:ignore.self>
                                    <div class="card-main mb-0">
                                        @foreach ($variation->variationValues as $value)
                                            <div class="form-auth-row" wire:key="var-side-{{$loop->index}}">
                                                <label for="#" class="ui-checkbox">
                                                    <input id="var-side-{{$loop->index}}"
                                                           @checked(array_key_exists($variation->id,$filterd['variation']) &&
                                                       in_array($value->value,$filterd['variation'][$variation->id]))
                                                           wire:click="addFilter('variation','{{$variation->id}}','{{$value->value}}')"
                                                           type="checkbox" value="1">
                                                    <span class="ui-checkbox-check"></span>
                                                </label>
                                                <label for="var-side-{{$loop->index}}"
                                                       class="remember-me">{{$value->value}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </div>
    <div onclick="closeSidebar(event)" class="filter-sidebar-overlay d-none" wire:ignore></div>
    <!-- end mobile product filter sidebar -->
</div>

@push('scripts')
    <script>
        // price range slider
        var nonLinearStepSlider = document.getElementById("slider-non-linear-step");
        var nonLinearStepSlider2 = document.getElementById("slider-non-linear-step2");

        Livewire.on('filterReset', () => {
            nonLinearStepSlider.noUiSlider.reset();
            nonLinearStepSlider2.noUiSlider.reset()
        })
        if ($("#slider-non-linear-step").length) {
            noUiSlider.create(nonLinearStepSlider, {
                start: [0, parseInt("{{$filterd['price']['high']}}")],
                connect: true,
                step: 1000,
                direction: "rtl",
                format: wNumb({
                    decimals: 0,
                }),
                range: {
                    min: [0],
                    max: [parseInt("{{$filterd['price']['high']}}")],
                },
            });

            nonLinearStepSlider.noUiSlider.on("change", function (values) {
                values.forEach((element, index) => {
                    values[index] = parseInt(element);
                });
                Livewire.emit('priceRangeUpdated', values);
                nonLinearStepSlider2.noUiSlider.set(values);
            });
        }
        // sidebar price range slider
        if ($("#slider-non-linear-step2").length) {
            noUiSlider.create(nonLinearStepSlider2, {
                start: [0, parseInt("{{$filterd['price']['high']}}")],
                connect: true,
                step: 1000,
                direction: "rtl",
                format: wNumb({
                    decimals: 0,
                }),
                range: {
                    min: [0],
                    max: [parseInt("{{$filterd['price']['high']}}")],
                },
            });
            nonLinearStepSlider2.noUiSlider.on("change", function (values) {
                values.forEach((element, index) => {
                    values[index] = parseInt(element);
                });
                Livewire.emit('priceRangeUpdated', values)
                nonLinearStepSlider.noUiSlider.set(values);
            });
        }

        function openSidebar() {
            $('#filter-sidebar').addClass('open')
            $('.filter-sidebar-overlay').removeClass('d-none');
        }

        function closeSidebar(event) {
            $('#filter-sidebar').removeClass('open')
            $('.filter-sidebar-overlay').addClass('d-none');
        }
    </script>
@endpush
