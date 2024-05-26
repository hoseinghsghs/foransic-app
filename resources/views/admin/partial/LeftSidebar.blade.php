@php
    $roles = \Spatie\Permission\Models\Role::all()->pluck('name')->toArray();
@endphp
<aside id="leftsidebar" class="sidebar">

    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="{{ route('admin.home') }}"><img
                src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}"
                style="margin-right:50px;max-height: 3rem;" height="37px" alt="meta-webs"><span
                class="m-l-10"></span></a>
    </div>
    <div class="menu">
        <ul class="list" id="myList">
            <li>
                <div class="user-info flex-wrap">
                    <a class="image" href="#"><img alt="profile image" src="{{ auth()->user()->avatar ? asset('storage/profile/' . auth()->user()->avatar) : asset('img/profile.png') }}"></a>
                    <div class="detail">
                        {{-- {{ auth()->user()->avatar ? asset('storage/profile/' . auth()->user()->avatar) : asset('img/profile.png') }} --}}
                        <h6><strong>{{ auth()->user()->name ?? auth()->user()->cellphone }}</strong></h6>
                        @hasanyrole($roles)
                        <small>{{ auth()->user()->roles->first()->name }}</small>
                        @endhasanyrole
                    </div>
                    <div class="w-100 d-flex justify-content-around d-md-none">
                        @hasanyrole($roles)
                        <span class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle p-1" title="Notifications"
                                   data-toggle="dropdown" role="button"><i
                                        class="zmdi zmdi-notifications text-black"></i>
                                    <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                                </a>
                                <ul class="dropdown-menu js-right-sidebar">
                                    <li class="header">اطلاعیه ها</li>

                                    @livewire('admin.events.event-list')

                                    <li class="footer"> <a href="javascript:void(0);">مشاهده تمام اعلان ها</a> </li>
                                </ul>
                            </span>
                        @endhasanyrole
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

            @hasanyrole($roles)
            <li @class(['active' => request()->routeIs('admin.home')])>
                <a href="{{ route('admin.home') }}"><i class="zmdi zmdi-view-dashboard zmdi-hc-1x"></i><span>
                            داشبورد</span>
                </a>
            </li>

            @canany(['laboratories-list','laboratories-create','laboratories-edit','laboratories-delete'])
                <li @class([
                        'active open' => request()->routeIs('admin.laboratory'),
                    ])>
                    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-city-alt"></i><span>
                                مدیریت آزمایشگاه ها</span></a>
                    <ul class="ml-menu">
                        @can('laboratories-list')
                            <li @class(['active' => request()->routeIs('admin.laboratory')])><a
                                    href={{ route('admin.laboratory') }}> آزمایشگاه ها</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['dossiers-list', 'dossiers-create', 'dossiers-edit', 'dossiers-delete', 'dossiers-archive-list','dossiers-export'])
                <li @class([
                        'active open' => request()->routeIs(
                            'admin.dossiers.archive',
                            'admin.dossiers.*'),
                    ])>
                    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-file"></i><span>پرونده
                                ها</span></a>
                    <ul class="ml-menu">
                        @can('dossiers-create')
                            <li @class(['active' => request()->routeIs('admin.dossiers.create')])><a
                                    href={{ route('admin.dossiers.create') }}>ثبت پرونده</a></li>
                        @endcan
                        @can('dossiers-list')
                            <li @class(['active' => request()->routeIs('admin.dossiers.index')])><a
                                    href={{ route('admin.dossiers.index') }}>لیست پرونده ها</a>
                            </li>
                        @endcan
                        @can('dossiers-archive-list')
                            <li @class(['active' => request()->routeIs('admin.dossiers.archive')])><a
                                    href={{ route('admin.dossiers.archive') }}>لیست پرونده های
                                    بایگانی</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['devices-list','devices-archive-list', 'devices-create', 'categories-list','attributes-list',
                'actions-category-list'])
                <li @class([
                        'active open' => request()->routeIs(
                            'admin.devices.*',
                            'admin.actions.*'),
                    ])>
                    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-devices"></i><span>شواهد دیجیتال
                            </span></a>
                    <ul class="ml-menu">
                        @can('devices-create')
                            <li @class(['active' => request()->routeIs('admin.devices.create')])><a
                                    href={{ route('admin.devices.create') }}>ثبت پذیرش
                                    شواهد دیجیتال</a></li>
                        @endcan
                        @can(['devices-list'])
                            <li @class(['active' => request()->routeIs(['admin.devices.index','admin.devices.edit','admin.devices.show'])])>
                                <a
                                    href={{ route('admin.devices.index') }}>لیست شواهد دیجیتال</a>
                            </li>
                        @endcan
                        @can(['devices-archive-list'])
                            <li @class(['active' => request()->routeIs('admin.devices.archive')])><a
                                    href={{ route('admin.devices.archive') }}>لیست شواهد دیجیتال بایگانی
                                </a>
                            </li>
                        @endcan
                        @canany(['categories-list'])
                            <li @class(['active' => request()->routeIs('admin.devices.category')])><a
                                    href={{ route('admin.devices.category') }}>دسته بندی شواهد دیجیتال
                                    ها</a>
                            </li>
                        @endcanany
                        @canany(['attributes-list'])
                            <li @class(['active' => request()->routeIs('admin.devices.attribute')])><a
                                    href={{ route('admin.devices.attribute') }}>ویژگی های دسته بندی</a>
                            </li>
                        @endcanany
                        @can(['actions-category-list'])
                            <li @class(['active' => request()->routeIs('admin.actions.category')])><a
                                    href={{ route('admin.actions.category') }}> اضافه کردن عنوان
                                    اقدام
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['users-list', 'users-create', 'roles', 'permissions','roles'])
                <li @class([
                        'active open' => request()->routeIs(
                            'admin.users.*',
                            'admin.permissions',
                            'admin.roles.*'),
                    ])><a href="javascript:void(0);" class="menu-toggle"><i
                            class="zmdi zmdi-hc-fw"></i><span>کاربران</span></a>
                    <ul class="ml-menu">
                        @can('users-create')
                            <li @class(['active' => request()->routeIs('admin.users.create')])><a
                                    href={{ route('admin.users.create') }}>افزودن کاربر</a></li>
                        @endcan
                        @can('users-list')
                            <li @class(['active' => request()->routeIs(['admin.users.index','admin.users.edit','admin.users.show'])])>
                                <a
                                    href={{ route('admin.users.index') }}>لیست کاربران</a></li>
                        @endcan
                        @can('roles')
                            <li @class(['active' => request()->routeIs('admin.roles.*')])><a
                                    href={{ route('admin.roles.index') }}>گروه های کاربری</a></li>
                        @endcan
                        @can('permissions')
                            <li @class(['active' => request()->routeIs('admin.permissions')])><a
                                    href={{ route('admin.permissions') }}>مجوز ها</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            <li @class([
                        'active open' => request()->routeIs(
                            'admin.guides.images',
                            'admin.guides.videos',
                            'admin.guides.files'),
                    ])><a href="javascript:void(0);" class="menu-toggle"><i
                        class="zmdi zmdi-help"></i><span>آموزش</span></a>
                <ul class="ml-menu">
                    <li @class(['active' => request()->routeIs('admin.guides.images')])><a
                            href={{ route('admin.guides.images') }}>تصاویر</a></li>
                    <li @class(['active' => request()->routeIs('admin.guides.videos')])><a
                            href={{ route('admin.guides.videos') }}>ویدیو</a></li>
                    <li @class(['active' => request()->routeIs('admin.guides.files')])><a
                            href={{ route('admin.guides.files') }}>فایل</a></li>
                </ul>
            </li>
            @can('events')
                <li @class(['active' => request()->routeIs('admin.timeline.*')])><a href={{ route('admin.timeline') }}>
                        <i class="zmdi zmdi-notifications"></i><span>مدیریت رویداد ها</span></a>
                </li>
            @endcan

            <li @class(['active' => request()->routeIs('admin.profile.edit')])><a
                    href={{ route('admin.profile.edit') }}>
                    <i class="zmdi zmdi-account-box"></i><span>ویرایش پروفایل</span></a>
            </li>

            <li @class(['active' => request()->routeIs('admin.profile.change-pass')])><a
                    href={{ route('admin.profile.change-pass') }}>
                    <i class="zmdi zmdi-key"></i><span>تغیر رمزعبور</span></a>
            </li>
            @can('settings')
                <li @class(['active' => request()->routeIs('admin.settings.show')])><a
                        href={{ route('admin.settings.show') }}>
                        <i class="zmdi zmdi-settings"></i><span>تنظیمات</span></a>
                </li>
            @endcan
            @endhasanyrole
        </ul>
    </div>
</aside>
@push('scripts')
    <script>
        $(document).ready(function () {
            $("#searchInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#myList li").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $(document).ready(function () {
            if ($("#cheack_collapsed").hasClass("ls-toggle-menu")) {
                $('#search-item').hide();
            } else {
                $('#search-item').show();
            }

            $('.btn-menu').on('click', function () {
                if ($("#cheack_collapsed").hasClass("ls-toggle-menu")) {
                    $('#search-item').hide();
                } else {
                    $('#search-item').show();
                }
            });
        });
    </script>
@endpush
