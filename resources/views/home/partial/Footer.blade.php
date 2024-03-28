{{-- <!-- footer------------------------------------------->
<footer class="footer-main-site">
    @if ($services->count() > 0)
        <section class="d-block d-xl-block d-lg-block d-md-block d-sm-block order-1">
            <div class="footer-shopping-features">
                <div class="container-fluid">
                    <div class="col-12">
                        @foreach ($services as $service)
                            <div class="item col-6">
                                <span class="icon-shopping">
                                    <img src="{{ asset('storage/services/' . $service->image) }}"
                                        alt="{{ $service->title }}" width="56" height="56">
                                </span>
                                <span class="title-shopping">{{ $service->title }}</span>
                                <span class="desc-shopping">{{ $service->description }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="d-block d-xl-block d-lg-block d-md-block d-sm-block order-1">
        <div class="container-fluid">
            <div class="col-12">
                <div class="footer-middlebar">
                    @if ($setting->site_name || $setting->description)
                        <div class="col-lg-9 pr">
                            <div class="footer-content d-block">
                                <div class="text pr-1">
                                    @isset($setting->site_name)
                                        <h2 class="title">فروشگاه اینترنتی {{ $setting->site_name }}</h2>
                                    @endisset
                                    @isset($setting->description)
                                        <p class="desc">{{ $setting->description }}</p>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($setting->instagram || $setting->whatsapp || $setting->telegram)
                        <div class="col-lg-3 d-block pl mt-lg-0 mt-3">
                            <div class="shortcode-widget-area">
                                <form action="#" class="form-newsletter">
                                    <fieldset>
                                        <span class="form-newsletter-title text-center">ما را در شبکه‌های اجتماعی دنبال
                                            کنید</span>
                                        <div class="social-container">
                                            <ul class="social-icons">
                                                @isset($setting->instagram)
                                                    <li><a href="{{ $setting->instagram }}" alt="social"><i
                                                                class="fa fa-instagram"></i></a>
                                                    </li>
                                                @endisset
                                                @isset($setting->whatsapp)
                                                    <li><a href="{{ $setting->whatsapp }}" alt="social"><i
                                                                class="fa fa-whatsapp"></i></a>
                                                    </li>
                                                @endisset
                                                @isset($setting->telegram)
                                                    <li><a href="{{ $setting->telegram }}" alt="social"><i
                                                                class="fa fa-telegram"></i></a>
                                                    </li>
                                                @endisset
                                            </ul>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    @endif
                    <div class="footer-more-info mb-2 mb-lg-5">
                        @if (!empty(json_decode($setting->links, true)))
                            <div class="col-lg-9 col-md-8 d-block pr">
                                <div class="footer-links">
                                    @foreach (json_decode($setting->links, true) as $pLink)
                                        <div class="col-lg-3 col-md-3 col-xs-12 pr">
                                            <div class="row">
                                                <section class="footer-links-col">
                                                    <div class="headline-links">
                                                        <a href="#">
                                                            {{ $pLink['name'] }}
                                                        </a>
                                                    </div>
                                                    @isset($pLink['children'])
                                                        <ul class="footer-menu-ul mr-2">
                                                            @foreach ($pLink['children'] as $link)
                                                                <li class="menu-item-type-custom">
                                                                    <a href="{{ $link['url'] }}">
                                                                        {{ $link['title'] }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endisset
                                                </section>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-3 col-md-4 pl">
                            <div class="licences d-flex mx-auto">
                                <div class="ml-1">
                                  <img referrerpolicy='origin' id = 'rgvjwlaoapfujxlzwlaojzpe' style = 'cursor:pointer' onclick = 'window.open("https://logo.samandehi.ir/Verify.aspx?id=345147&p=xlaoaodsdshwrfthaodsjyoe", "Popup","toolbar=no, scrollbars=no, location=no, statusbar=no, menubar=no, resizable=0, width=450, height=630, top=30")' alt = 'logo-samandehi' src = 'https://logo.samandehi.ir/logo.aspx?id=345147&p=qftishwlujynnbpdshwlyndt' />
                                </div>
                                <div>
                                  <a referrerpolicy="origin" target="_blank" href="https://trustseal.enamad.ir/?id=331288&amp;Code=SDMt8Jycoig8oHiem4b2"><img referrerpolicy="origin" src="https://Trustseal.eNamad.ir/logo.aspx?id=331288&amp;Code=SDMt8Jycoig8oHiem4b2" alt="" style="cursor:pointer" id="SDMt8Jycoig8oHiem4b2"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-copyright">
                        <div class="footer-copyright-text">
                            <p>تمامی حقوق متعلق به سایت فروشگاهی {{ $setting->site_name }} می باشد.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</footer>
<!-- footer----------------------------------> --}}
