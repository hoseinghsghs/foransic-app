<div>
    @section('title', 'سبد خرید')
    <!-- cart---------------------------------->
    <div class="container-main">
        <div class="d-block">
            <div class="main-row">
                <div id="breadcrumb">
                    <i class="mdi mdi-home"></i>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">خانه</a></li>
                            <li class="breadcrumb-item active" aria-current="page">سبد خرید</li>
                        </ol>
                    </nav>
                </div>
                <section class="cart-home">
                    <div class="post-item-cart d-block order-2">
                        <div class="content-page">
                            <div class="cart-form">
                                <div class="row">
                                    @if (\Cart::isEmpty())
                                        <div class="cart-empty text-center d-block col-12">
                                            <div class="cart-empty-img mb-4 mt-4">
                                                <img src="/assets/home/images/shopping-cart.png">
                                            </div>
                                            <p class="cart-empty-title">سبد خرید شما در حال حاضر خالی است.</p>
                                            <div class="return-to-shop">
                                                <a href="{{ route('home') }}" class="backward btn btn-secondary">ادامه
                                                    خرید</a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-lg-8 col-md-8 col-12 mt-4">
                                            <form action="#" class="c-form">
                                                <table class="table-cart cart table table-borderless">
                                                    <thead>
                                                        <tr class="cart-tr-personal">
                                                            <th scope="col" class="product-cart-name">نام محصول</th>
                                                            <th scope="col" class="product-cart-price">قیمت</th>
                                                            <th scope="col" class="product-cart-quantity">تعداد مورد
                                                                نیاز
                                                            </th>
                                                            <th scope="col" class="product-cart-Total">مجموع</th>
                                                            <th scope="col" class="product-cart-Total"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($cartitems->sort() as $item)
                                                            <tr wire:key="cart-'{{ $item->id }}'">
                                                                @php
                                                                    $quantity = $item->quantity;
                                                                @endphp
                                                                <td class="d-md-none">
                                                                    <a class="remove"
                                                                        wire:click="delete('{{ $item->id }}')">
                                                                        <i class="mdi mdi-close" wire:loading.remove
                                                                            wire:target="delete('{{ $item->id }}')"></i>
                                                                        <i class="fa fa-circle-o-notch fa-spin"
                                                                            wire:loading
                                                                            wire:target="delete('{{ $item->id }}')"></i>
                                                                    </a>
                                                                </td>
                                                                <th scope="row" class="product-cart-name">
                                                                    <div class="product-thumbnail-img">
                                                                        <a
                                                                            href="{{ route('home.products.show', ['product' => $item->associatedModel->slug]) }}">
                                                                            <img
                                                                                src="{{ url(env('PRODUCT_PRIMARY_IMAGES_UPLOAD_PATCH') . $item->associatedModel->primary_image) }}">
                                                                        </a>
                                                                    </div>
                                                                    <a
                                                                        href="{{ route('home.products.show', ['product' => $item->associatedModel->slug]) }}">
                                                                        {{ $item->name }}
                                                                    </a>
                                                                    <div class="variation"> <span
                                                                            class="variant-color-title">
                                                                            {{ \App\Models\Attribute::find($item->attributes->attribute_id)->name }}
                                                                            :
                                                                            {{ $item->attributes->value }}</span>
                                                                        <div class="variant-shape"></div>
                                                                        <div class="seller">
                                                                            <i class="mdi mdi-storefront"></i>
                                                                            فروشنده :
                                                                            <span>{{ env('APP_NAME') }}</span>
                                                                        </div>
                                                                    </div>
                                                                </th>
                                                                <td class="product-cart-price">
                                                                    <span>
                                                                        <span>{{ number_format($item->price) }}</span>
                                                                        <span>تومان</span>
                                                                    </span>
                                                                    @if ($item->attributes->is_sale)
                                                                        <p class="text-danger">
                                                                            {{ $item->attributes->percent_sale }}%
                                                                            تخفیف
                                                                        </p>
                                                                    @endif </span>
                                                                </td>
                                                                <td class="product-cart-quantity">
                                                                    <div class="required-number before">
                                                                        <div class="quantity"> <input
                                                                                class="quantity form-control" readonly
                                                                                value="{{ $item->quantity }}"
                                                                                type="number" min="1"
                                                                                step="1"
                                                                                max="{{ $item->attributes->quantity }}">
                                                                            <div class="quantity-nav">
                                                                                <div class="quantity-button quantity-up"
                                                                                    wire:loading.attr="disabled"
                                                                                    wire:click="increment('{{ $item->id }}')">
                                                                                    +</div>
                                                                                <div class="quantity-button quantity-down"
                                                                                    wire:loading.attr="disabled"
                                                                                    wire:click="decrement('{{ $item->id }}')">
                                                                                    -</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="product-cart-Total product-subtotal">
                                                                    <center class="amount" id="product-subtotal"
                                                                        style="align-items: center;justify-content: center;"
                                                                        wire:loading.flex>
                                                                        <i
                                                                            class="fa fa-circle-o-notch fa-spin text-danger"></i>
                                                                    </center>
                                                                    <span id="product-subtotal" wire:loading.remove>
                                                                        <span>{{ number_format($item->price * $item->quantity) }}</span>
                                                                        <span>تومان</span>
                                                                    </span>
                                                                </td>
                                                                <td class="d-none d-md-block">
                                                                    <a class="remove"
                                                                        wire:click="delete('{{ $item->id }}')">
                                                                        <i class="mdi mdi-close" wire:loading.remove
                                                                            wire:target="delete('{{ $item->id }}')"></i>
                                                                        <i class="fa fa-circle-o-notch fa-spin "
                                                                            wire:loading
                                                                            wire:target="delete('{{ $item->id }}')"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </form>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="cart-collaterals">
                                                <div class="totals">
                                                    <div>
                                                        <h3 class="Total-cart-total d-flex justify-content-center">مجموع
                                                            کل
                                                            سبد خرید</h3>
                                                    </div>

                                                    <div class="checkout-summary row pl-1 pt-2">
                                                        <ul
                                                            class="checkout-summary-summary col-md-12 d-flex justify-content-center">
                                                            <table
                                                                class="checkout-review-order-table table table-borderless mb-3 d-flex justify-content-center">
                                                                <tfoot>
                                                                    <tr class="cart-subtotal">
                                                                        <th class="amount">مبلغ سفارش</th>
                                                                        <td wire:loading.remove>
                                                                            {{ number_format(\Cart::getTotal() + cartTotalSaleAmount()) }}
                                                                            تومان

                                                                        </td>
                                                                        <td wire:loading.flex>
                                                                            <i style="display: inline-flex"
                                                                                class="fa fa-circle-o-notch fa-spin text-warning"></i>
                                                                        </td>
                                                                    </tr>
                                                                    @if (cartTotalSaleAmount())
                                                                        <tr class="cart-subtotal">
                                                                            <td class="amount text-success">مبلغ تخفیف
                                                                                کالا</td>
                                                                            <td class="text-success"
                                                                                wire:loading.remove>
                                                                                {{ number_format(cartTotalSaleAmount()) }}
                                                                                تومان
                                                                            </td>
                                                                            <td wire:loading.flex>
                                                                                <i style="display: inline-flex"
                                                                                    class="fa fa-circle-o-notch fa-spin text-warning"></i>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                    <tr class="shipping-totals">

                                                                        <td class="amount">حمل و نقل</td>
                                                                        @if (cartTotalDeliveryAmount('post') == 0)
                                                                            <td style="color:#31ab00"
                                                                                wire:loading.remove>
                                                                                رایگان
                                                                            </td>
                                                                        @else
                                                                            <td wire:loading.remove>
                                                                                {{ number_format(cartTotalDeliveryAmount('post')) }}
                                                                                تومان
                                                                            </td>
                                                                        @endif
                                                                        <td wire:loading.flex>
                                                                            <i style="display: inline-flex"
                                                                                class="fa fa-circle-o-notch fa-spin text-warning"></i>
                                                                        </td>

                                                                    </tr>
                                                                    @if (session()->get('coupon.amount'))
                                                                        <tr>
                                                                            <td class="amount text-success">کد تخفیف
                                                                            </td>
                                                                            <td class="text-success"
                                                                                wire:loading.remove>
                                                                                {{ number_format(session()->get('coupon.amount')) }}
                                                                                تومان
                                                                            </td>
                                                                            <td wire:loading.flex>
                                                                                <i style="display: inline-flex"
                                                                                    class="fa fa-circle-o-notch fa-spin text-warning"></i>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                    <tr class=" order-total">
                                                                        <td class="amount"> مجموع</td>
                                                                        <td wire:loading.remove>
                                                                            {{ number_format(cartTotalAmount('post')) }}
                                                                            تومان
                                                                            </span>
                                                                        </td>
                                                                        <td wire:loading.flex>
                                                                            <i style="display: inline-flex"
                                                                                class="fa fa-circle-o-notch fa-spin text-warning"></i>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </ul>
                                                        <div class="checkout-summary-summary col-md-12 d-contents">
                                                            <div class="discount-code">
                                                                <div
                                                                    class=" align-items-center d-flex justify-content-center">
                                                                    <a wire:loading.flex>
                                                                        <i style="display: inline-flex"
                                                                            class="fa fa-circle-o-notch fa-spin fa-lg	 text-warning"></i>
                                                                    </a>
                                                                    <a href="{{ route('home.orders.checkout') }}"
                                                                        wire:loading.remove
                                                                        class="checkout-button btn btn-info btn-sm m-1">تسویه
                                                                        حساب</a>
                                                                    <span wire:loading.remove>
                                                                        <a wire:click="clearCart()"
                                                                            class="checkout-button btn btn-danger btn-sm m-1">پاک
                                                                            کردن
                                                                            سبد</a>
                                                                    </span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    <!-- cart---------------------------------->
</div>
