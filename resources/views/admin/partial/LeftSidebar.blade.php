<aside id="leftsidebar" class="sidebar">

    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="{{ route('admin.home') }}"><img
                src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}"
                style="margin-right:20px;max-height: 3rem;" height="37px" alt="meta-webs"><span
                class="m-l-10"></span></a>
    </div>
    <div class="menu">
        <ul class="list" id="myList">
            <li>
                <div class="user-info flex-wrap">
                    <a class="image" href="#"><img src="{{ asset('img/profile.png') }}"></a>
                    <div class="detail">
                        {{-- {{ auth()->user()->avatar ? asset('storage/profile/' . auth()->user()->avatar) : asset('img/profile.png') }} --}}
                        {{-- <h6><strong>{{ auth()->user()->name ?? auth()->user()->cellphone }}</strong></h6> --}}
                        {{-- <small>{{ auth()->user()->roles->first()->name }}</small> --}}
                    </div>
                    <div class="w-100 d-flex justify-content-around d-md-none">
                        <span class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle p-1" title="Notifications"
                                data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications text-black"></i>
                                <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                            </a>
                            <ul class="dropdown-menu js-right-sidebar">
                                <li class="header">اطلاعیه ها</li>

                                @livewire('admin.events.event-list')

                                <li class="footer"> <a href="javascript:void(0);">مشاهده تمام اعلان ها</a> </li>
                            </ul>
                        </span>
                        <span><a href="javascript:void(0);" class="js-right-sidebar p-1" title="Setting"><i
                                    class="zmdi zmdi-settings zmdi-hc-spin text-black"></i></a></span>
                        <span><a href="#"
                                onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                                class="p-1" title="Sign Out"><i class="zmdi zmdi-power"></i></a>
                            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </span>
                    </div>
                </div>
            </li>

            <li>
                <div class="form-group row mr-1" id="search-item">
                    <label for="inputEmail3" class="col-11 col-form-label">جستجو </label>
                    <div class="col-11">
                        <input id="searchInput" class="form-control col-md-11" placeholder="یک عبارت بنویسید....">
                    </div>
                </div>
            </li>

            <li @class(['active' => request()->routeIs('admin.home')])>
                <a href="{{ route('admin.home') }}"><i class="zmdi zmdi-view-dashboard zmdi-hc-1x"></i><span>
                        داشبورد</span>
                </a>
            </li>

            @canany(['users', 'roles', 'permissions'])
                <li @class([
                    'active open' => request()->routeIs(
                        'admin.users.*',
                        'admin.permissions',
                        'admin.roles.*'),
                ])><a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-hc-fw"></i><span>کاربران</span></a>
                    <ul class="ml-menu">
                        @can('users')
                            <li @class(['active' => request()->routeIs('admin.users.*')])><a href={{ route('admin.users.index') }}>لیست کاربران</a></li>
                        @endcan
                        @can('roles')
                            <li @class(['active' => request()->routeIs('admin.roles.*')])><a href={{ route('admin.roles.index') }}>گروه های کاربری</a></li>
                        @endcan
                        @can('permissions')
                            <li @class(['active' => request()->routeIs('admin.permissions')])><a href={{ route('admin.permissions') }}>مجوز ها</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['products', 'categories', 'attributes', 'coupons'])
                <li @class([
                    'active open' => request()->routeIs(
                        'admin.archive',
                        'admin.products.*',
                        'admin.categories.*',
                        'admin.attributes.*',
                        'admin.coupons.*'),
                ])>
                    <a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-hc-fw"></i><span>دیوایس</span></a>
                    <ul class="ml-menu">
                        @can('products')
                            <li @class(['active' => request()->routeIs('admin.devices.index')])><a href={{ route('admin.devices.index') }}>لیست دیوایس</a></li>

                            <li @class(['active' => request()->routeIs('admin.archive')])><a href={{ route('admin.archive') }}>لیست دیوایس بایگانی شده</a>
                            </li>

                            <li @class(['active' => request()->routeIs('admin.devices.create')])><a href={{ route('admin.devices.create') }}>ایجاد دیوایس</a></li>
                        @endcan

                    </ul>
                </li>
            @endcanany


            @can('galeries')
                <li @class(['active open' => request()->routeIs('admin.galeries.*')])><a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-collection-folder-image"></i><span>گالری</span></a>
                    <ul class="ml-menu">
                        <li @class(['active' => request()->routeIs('admin.galeries.index')])><a href={{ route('admin.galeries.index') }}>گالری تصاویر</a></li>
                    </ul>
                </li>
            @endcan




            @can('events')
                <li @class(['active' => request()->routeIs('admin.timeline.*')])><a href={{ route('admin.timeline') }}>
                        <i class="zmdi zmdi-notifications"></i><span>مدیریت رویداد ها</span></a>
                </li>
            @endcan



            @can('sms')
                <li @class(['active' => request()->routeIs('admin.sms.*')])><a href={{ route('admin.sms.create') }}>
                        <i class="zmdi zmdi-hc-fw"></i><span>ارسال اس ام اس</span></a>
                </li>
            @endcan

            <!-- تنظیمات -->
            <li @class([
                'active open' => request()->routeIs('admin.settings.*', 'admin.profile.*'),
            ])><a href="javascript:void(0);" class="menu-toggle"><i
                        class="zmdi zmdi-settings zmdi-hc-spin"></i><span>تنظیمات</span></a>
                <ul class="ml-menu">
                    @can('settings')
                        <li @class(['active' => request()->routeIs('admin.settings.show')])><a href="{{ route('admin.settings.show') }}">سایت</a></li>
                    @endcan
                    <li @class(['active' => request()->routeIs('admin.profile.edit')])><a href="{{ route('admin.profile.edit') }}">ویرایش پروفایل
                            کاربری
                        </a></li>
                    <li @class(['active' => request()->routeIs('admin.profile.change-pass')])><a href="{{ route('admin.profile.change-pass') }}">تغییر کلمه
                            عبور </a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
@push('scripts')
    <script>
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myList li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $(document).ready(function() {
            if ($("#cheack_collapsed").hasClass("ls-toggle-menu")) {
                $('#search-item').hide();
            } else {
                $('#search-item').show();
            }

            $('.btn-menu').on('click', function() {
                if ($("#cheack_collapsed").hasClass("ls-toggle-menu")) {
                    $('#search-item').hide();
                } else {
                    $('#search-item').show();
                }
            });
        });
    </script>
@endpush
