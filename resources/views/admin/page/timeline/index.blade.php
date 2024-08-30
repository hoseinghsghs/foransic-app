@extends('admin.layout.MasterAdmin')
@section('title', 'لیست رویداد ها')
@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>زمان بندی رویداد ها</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item active">زمان بندی رویداد ها</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-sm-12">
                    <ul class="cbp_tmtimeline">
                        @hasanyrole(['Super Admin','viewer'])
                        @foreach ($all_events as $event)

                        @php
                        if ($event->eventable_type == 'App\Models\Action') {
                        $icon = 'zmdi zmdi-case';
                        $bg = 'bg-green';
                        $url = route('admin.devices.show', App\Models\Action::find($event->eventable_id)->device->id);
                        } elseif ($event->eventable_type == 'App\Models\User') {
                        $icon = 'zmdi zmdi-account';
                        $bg = 'bg-yellow';
                        $url = route('admin.users.show', $event->eventable_id);
                        }
                        @endphp

                        <li>
                            <div class="cbp_tmicon"><i class="zmdi zmdi-account"></i></div>
                            <div class="cbp_tmlabel empty">
                                <h5><a href={{$url}}>{{ $event->title }}</a></h5>
                                <div>
                                    {{ $event->body }}
                                </div>
                                @php
                                $v2 = Hekmatinasser\Verta\Verta::instance($event->created_at);
                                $v3 = $v2->diffMinutes();
                                $v4 = $v3 . ' ' . 'دقیقه';
                                if ($v3 <= 0) { $v4=' لحظاتی پیش ' ; } if ($v3> 60) {
                                    $v3 = $v2->diffHours();
                                    $v4 = $v3 . ' ' . 'ساعت';
                                    if ($v3 > 60) {
                                    $v3 = $v2->diffDays();
                                    $v4 = $v3 . ' ' . 'روز';
                                    }
                                    }
                                    @endphp
                                    <p class="pt-2">
                                        {{ verta($event->created_at)->format('Y-n-j H:i')}}

                                    </p>
                                    <p class="mt-2"><i class="zmdi zmdi-time"></i><span> {{ $v4 }} پیش
                                        </span></p>

                                    <!-- <form style="float: left;" action="{{ route('admin.timeline.destroy', $event->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-raised btn-danger waves-effect" type="submit">حذف</button>
                                    </form> -->
                            </div>
                        </li>
                        @endforeach
                        @else
                        @foreach ($events as $event)
                        <li>
                            <div class="cbp_tmicon"><i class="zmdi zmdi-account"></i></div>
                            <div class="cbp_tmlabel empty">
                                <h5><a href="{{ route('admin.users.show', $event->eventable_id) }}">{{ $event->title }}</a></h5>
                                <div>
                                    {{ $event->body }}
                                </div>
                                @php
                                $v2 = Hekmatinasser\Verta\Verta::instance($event->created_at);
                                $v3 = $v2->diffMinutes();
                                $v4 = $v3 . ' ' . 'دقیقه';
                                if ($v3 <= 0) { $v4=' لحظاتی پیش ' ; } if ($v3> 60) {
                                    $v3 = $v2->diffHours();
                                    $v4 = $v3 . ' ' . 'ساعت';
                                    if ($v3 > 60) {
                                    $v3 = $v2->diffDays();
                                    $v4 = $v3 . ' ' . 'روز';
                                    }
                                    }
                                    @endphp
                                    <p class="pt-2">
                                        {{ verta($event->created_at)->format('Y-n-j H:i')}}

                                    </p>
                                    <p class="mt-2"><i class="zmdi zmdi-time"></i><span> {{ $v4 }} پیش
                                        </span></p>

                                    <!-- <form style="float: left;" action="{{ route('admin.timeline.destroy', $event->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-raised btn-danger waves-effect" type="submit">حذف</button>
                                    </form> -->
                            </div>
                        </li>
                        @endforeach
                        @endhasanyrole
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        {{ $events->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
