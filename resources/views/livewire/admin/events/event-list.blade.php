<div>
    <li class="body">
        <ul class="menu list-unstyled">
            @hasanyrole(['Super Admin','viewer'])
            @foreach ($evorders as $evorder)
                <li>
                    @php
                        if ($evorder->eventable_type == 'App\Models\Action') {
                            $icon = 'zmdi zmdi-file-plus';
                            $bg = 'bg-green';
                            $url = route('admin.devices.show', App\Models\Action::find($evorder->eventable_id)->device->id);
                            $width= "28%";
                        } elseif ($evorder->eventable_type == 'App\Models\User') {
                            $icon = 'zmdi zmdi-account';
                            $bg = 'bg-blue';
                            $url = route('admin.users.show', $evorder->eventable_id);
                            $width= "16%";

                        } elseif ($evorder->eventable_type == 'App\Models\Device') {
                            $icon = 'zmdi zmdi-devices';
                            $bg = 'bg-yellow';
                            $url = route('admin.devices.show', $evorder->eventable_id);
                            $width= "28%";

                        }elseif ($evorder->eventable_type == 'App\Models\Dossier') {
                            $icon = 'zmdi zmdi-file';
                            $bg = 'bg-orange';
                            $url = route('admin.dossiers.show', $evorder->eventable_id);
                            $width= "24%";

                        }
                    @endphp

                    <a href="{{ $url }}">
                        <div class="icon-circle {{$bg}}" style="width: {{$width}}"><i class="{{ $icon }}"></i></div>
                        <div class="menu-info" style="text-align: right">
                            <h4 >{{ $evorder->title }}</h4>
                            <h4  >{{ $evorder->body }}</h4>
                            <!-- <h4>{{ Hekmatinasser\Verta\Verta::instance($evorder->expired_at)->format('Y/n/j H:i:s') }}</h4> -->
                            <?php
                            $v2 = Hekmatinasser\Verta\Verta::instance($evorder->created_at);
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
                            ?>
                            <p><i class="zmdi zmdi-time"></i><span> {{ $v4 }} </span>
                            </p>
                        </div>
                    </a>
                </li>
            @endforeach
            @else
              @foreach ($events as $evorder)
                <li>
                    @php
                        if ($evorder->eventable_type == 'App\Models\Action') {
                            $icon = 'zmdi zmdi-file-plus';
                            $bg = 'bg-green';
                            $url = route('admin.devices.show', App\Models\Action::find($evorder->eventable_id)->device->id);
                            $width= "28%";
                        } elseif ($evorder->eventable_type == 'App\Models\User') {
                            $icon = 'zmdi zmdi-account';
                            $bg = 'bg-blue';
                            $url = route('admin.users.show', $evorder->eventable_id);
                            $width= "16%";

                        } elseif ($evorder->eventable_type == 'App\Models\Device') {
                            $icon = 'zmdi zmdi-devices';
                            $bg = 'bg-yellow';
                            $url = route('admin.devices.show', $evorder->eventable_id);
                            $width= "28%";

                        }elseif ($evorder->eventable_type == 'App\Models\Dossier') {
                            $icon = 'zmdi zmdi-file';
                            $bg = 'bg-orange';
                            $url = route('admin.dossiers.show', $evorder->eventable_id);
                            $width= "24%";

                        }
                    @endphp

                    <a href="{{ $url }}">
                        <div class="icon-circle {{$bg}}" style="width: {{$width}}"><i class="{{ $icon }}"></i></div>
                        <div class="menu-info" style="text-align: right">
                            <h4 >{{ $evorder->title }}</h4>
                            <h4  >{{ $evorder->body }}</h4>
                            <!-- <h4>{{ Hekmatinasser\Verta\Verta::instance($evorder->expired_at)->format('Y/n/j H:i:s') }}</h4> -->
                            <?php
                            $v2 = Hekmatinasser\Verta\Verta::instance($evorder->created_at);
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
                            ?>
                            <p><i class="zmdi zmdi-time"></i><span> {{ $v4 }} </span>
                            </p>
                        </div>
                    </a>
                </li>
            @endforeach
            @endhasrole
        </ul>
    </li>
</div>
