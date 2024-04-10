@extends('admin.layout.MasterAdmin')
@section('title', 'مشاهده کاربر')
@section('Content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>نمایش کاربر</h2>
                        <br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);"><a
                                        href={{ route('admin.users.index') }}>لیست کاربران</a></li>
                            <li class="breadcrumb-item active">نمایش کاربر</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                class="zmdi zmdi-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>مشخصات </strong>کاربر</h2>
                            </div>
                            <div class="body row">
                                <div class="col-sm-4">
                                    <div class="blogitem">
                                        <div class="blogitem-image">
                                            <a class="text-center"
                                                href="{{ $user->avatar ? asset('storage/profile/' . $user->avatar) : asset('img/profile.png') }}"
                                                target="_blank">
                                                <img class="img-fluid img-thumbnail w200"
                                                    src="{{ $user->avatar ? asset('storage/profile/' . $user->avatar) : asset('img/profile.png') }}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group col-sm-8">
                                    <button type="button" class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>نام کاربر:</strong></div>
                                            <div class="col-6">{{ $user->name }}</div>
                                        </div>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>ایمیل:</strong></div>
                                            <div class="col-6">{{ $user->email }}</div>
                                        </div>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>موبایل:</strong></div>
                                            <div class="col-6">{{ $user->cellphone }}</div>
                                        </div>
                                    </button>

                                    <button type="button" class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>تاریخ ایجاد حساب:</strong></div>
                                            <div class="col-6">{{ verta($user->created_at)->format('H:i Y/n/j') }}</div>
                                        </div>
                                    </button>
                                    <button type="button" class="list-group-item list-group-item-action">
                                        <div class="row clearfix">
                                            <div class="col-6"><strong>تاریخ آخرین بروزرسانی:</strong></div>
                                            <div class="col-6">{{ verta($user->updated_at)->format('H:i Y/n/j') }}</div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row clearfix">
                            <div class="header">
                                <h5 class="my-5">اقدامات اخیر کابر</h5>
                            </div>
                            <div class="col-sm-12">
                                @if (count($actions) === 0)
                                    <p>هیچ رکوردی وجود ندارد</p>
                                @else
                                    <ul class="cbp_tmtimeline">
                                        @foreach ($actions as $action)
                                            @php
                                                $v2 = Hekmatinasser\Verta\Verta::instance($action->created_at);
                                                $v3 = $v2->diffMinutes();
                                                $v4 = $v3 . ' ' . 'دقیقه';
                                                if ($v3 <= 0) {
                                                    $v4 = ' لحظاتی پیش ';
                                                }
                                                if ($v3 > 60) {
                                                    $v3 = $v2->diffHours();
                                                    $v4 = $v3 . ' ' . 'ساعت';
                                                    if ($v3 > 60) {
                                                        $v3 = $v2->diffDays();
                                                        $v4 = $v3 . ' ' . 'روز';
                                                    }
                                                }

                                            @endphp
                                            <li wire:key="{{ $action->description }} {{ $action->id }}"
                                                wire:loading.attr="disabled">
                                                <div class="cbp_tmicon"><i class="zmdi zmdi-account"></i>
                                                </div>
                                                <div class="cbp_tmlabel empty">
                                                    <div class="cbp_tmtime" style="background-color: #f170ff ">
                                                        <span style=" font-size: 1rem">{{ $v2 }}</span> --
                                                        <span>
                                                            <span class="mt-2"><i class="zmdi zmdi-time"></i><span
                                                                    style=" font-size: 1rem"> {{ $v4 }} پیش
                                                                </span></span>
                                                        </span>
                                                    </div>
                                                    <span style="float: right">
                                                        <td class="text-center js-sweetalert" style="float: left">
                                                            @if ($action->is_print)
                                                                <button class="btn btn-success">فعال در گزارش</button>
                                                            @else
                                                                <button class="btn btn-danger">غیر فعال در گزارش</button>
                                                            @endif
                                                            <button class="btn btn-default">تاریخ و زمان شروع:
                                                                {{ $action->start_date }}</button>
                                                            <button class="btn btn-default">تاریخ و زمان پایان:
                                                                {{ $action->end_date }}</button>
                                                            <?php
                                                            $device = \App\Models\Device::find($action->device_id);
                                                            ?>
                                                            <a href="{{ route('admin.actions.create', ['device' => $device->id]) }}"
                                                                class="btn btn-default"> دستگاه / قطعه:
                                                                {{ $device->name }}</a>

                                                    </span>
                                                    </td>
                                                    </span>
                                                    <h5 class="mt-5"><a href="#">توسط {{ $action->user->name }}
                                                        </a>
                                                    </h5>

                                                    <div>
                                                        {{ $action->description }}
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
