@section('title', 'ایجاد اقدام')
<section class="content">
    <div class="body_scroll">
    </div>
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>اضافه کردن اقدام</h2>
                </br>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                            خانه</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">اقدامات</a></li>
                    <li class="breadcrumb-item active">اقدام جدید</li>
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
    <div>
        <!-- Hover Rows -->
        <div class="container-fluid">
            <div class="tab-pane right_chat" id="chat">
                <div class="slim_scroll">
                    <div class="card">
                        <ul class="list-unstyled">
                            <li class="online">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="card">
                                            <div class="body">
                                                <div class="row clearfix">
                                                    <div
                                                        class="form-group col-md-12 col-sm-12 @error('description') is-invalid @enderror">
                                                        <label for="">توضیحات اقدام *</label>
                                                        <div>
                                                            @if ($is_edit)
                                                                <textarea class="form-control" wire:model.defer="description">{!! $action->description !!}</textarea>
                                                            @else
                                                                <textarea class="form-control" wire:model.defer="description">
                                                                </textarea>
                                                            @endif
                                                        </div>
                                                        @error('description')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label> تاریخ و زمان شروع</label>
                                                        <div class="input-group" wire:ignore>
                                                            <div class="input-group-prepend"
                                                                onclick="$('#startDate').focus();">
                                                                <span class="input-group-text" id="basic-addon1"><i
                                                                        class="zmdi zmdi-calendar-alt"></i></span>
                                                            </div>
                                                            <input type="hidden" id="startDate-alt"
                                                                name="variation_values" value="">
                                                            <input type="text" class="form-control" id="startDate"
                                                                value="" autocomplete="off">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon1"
                                                                    style="cursor: pointer;"
                                                                    onclick="destroyDatePicker('from')"><i
                                                                        class="zmdi zmdi-close"></i></span>
                                                            </div>
                                                            <span id="start_date-display" class="text-warning"></span>
                                                            @error('start_date')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label>تاریخ و زمان پایان</label>
                                                        <div class="input-group" wire:ignore>
                                                            <div class="input-group-prepend"
                                                                onclick="$('#endDate').focus();">
                                                                <span class="input-group-text" id="basic-addon1"><i
                                                                        class="zmdi zmdi-calendar-alt"></i></span>
                                                            </div>
                                                            <input type="hidden" id="endDate-alt"
                                                                name="variation_values">
                                                            <input type="text" class="form-control" id="endDate"
                                                                value="{{ $end_date ?? null }}" autocomplete="off">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon1"
                                                                    style="cursor: pointer;"
                                                                    onclick="destroyDatePicker('to')"><i
                                                                        class="zmdi zmdi-close"></i></span>
                                                            </div>
                                                            <span id="start_date-display" class="text-warning"></span>
                                                            @error('end_date')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <div class="form-group">
                                                            <label>وضعیت</label>
                                                            <div class="form-line">
                                                                <select data-placeholder="وضعیت"
                                                                    wire:model.live="status" class="form-control ms">
                                                                    <option value="">وضعیت</option>
                                                                    <option value="1">فعال</option>
                                                                    <option value="0">غیرفعال</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <div class="form-group">
                                                            <label>نمایش در گزارش و پرینت</label>
                                                            <div class="form-line">
                                                                <select data-placeholder="وضعیت"
                                                                    wire:model.live="is_print" class="form-control ms">
                                                                    <option value="">وضعیت</option>
                                                                    <option value="1">فعال</option>
                                                                    <option value="0">غیرفعال</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-sm-12">
                                                        <button wire:click="addAction" wire:loading.attr="disabled"
                                                            class="btn btn-raised {{ $is_edit ? 'btn-warning' : 'btn-primary' }}  waves-effect">
                                                            {{ $is_edit ? 'ویرایش' : 'افزودن' }}
                                                            <span class="spinner-border spinner-border-sm text-light"
                                                                wire:loading wire:target="addAction"></span>
                                                        </button>
                                                        @if ($is_edit)
                                                            <button class="btn btn-raised btn-info waves-effect"
                                                                wire:loading.attr="disabled" wire:click="ref">صرف
                                                                نظر
                                                                <span
                                                                    class="spinner-border spinner-border-sm text-light"
                                                                    wire:loading wire:target="ref"></span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #END# Hover Rows -->
            <!-- لیست -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>لیست اقدامات </strong>( {{ $actions->total() }} )</h2>
                        </div>
                        <div class="body">
                            @if (count($actions) === 0)
                                <p>هیچ رکوردی وجود ندارد</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover c_table theme-color">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>نام پرسنل</th>
                                                <th>تاریخ و زمان شروع</th>
                                                <th>تاریخ و زمان پایان</th>
                                                <th>نمایش در گزارش</th>
                                                <th>توضیح</th>
                                                <th class="text-center js-sweetalert">عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($actions as $key => $action)
                                                <tr wire:key="{{ $action->description }} {{ $action->id }}"
                                                    wire:loading.attr="disabled">
                                                    <td scope="row">{{ $action->id }}</td>
                                                    <td scope="row">{{ $action->user->name }} -
                                                        {{ $action->user->cellphone }}</td>
                                                    <td dir="ltr">{{ $action->start_date }}</td>
                                                    <td dir="ltr">{{ $action->end_date }}</td>
                                                    <td>
                                                        @if ($action->is_print)
                                                            <sapn class='badge badge-success'> فعال </span>
                                                            @else
                                                                <sapn class='badge badge-danger'>غیر فعال </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn bg-teal waves-effect"
                                                            data-toggle="modal"
                                                            data-target="#defaultModal-{{ $key }}"><i
                                                                class="zmdi zmdi-eye"></i></button>
                                                    </td>
                                                    <td class="text-center js-sweetalert">
                                                        <button wire:click="edit_action({{ $action->id }})"
                                                            wire:loading.attr="disabled" {{ $display }}
                                                            class="btn btn-raised btn-info waves-effect scroll">
                                                            <i class="zmdi zmdi-edit"></i>
                                                            <span class="spinner-border spinner-border-sm text-light"
                                                                wire:loading
                                                                wire:target="edit_action({{ $action->id }}) "></span>
                                                        </button>
                                                        <button class="btn btn-raised btn-danger waves-effect"
                                                            wire:loading.attr="disabled"
                                                            wire:click="del_action({{ $action->id }})"
                                                            {{ $display }}>
                                                            <i class="zmdi zmdi-delete"></i>

                                                            <span class="spinner-border spinner-border-sm text-light"
                                                                wire:loading
                                                                wire:target="del_action({{ $action->id }})"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="defaultModal-{{ $key }}"
                                                    tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">{{ $action->description }}</div>
                                                            <div class="modal-footer">

                                                                <button type="button"
                                                                    class="btn btn-danger waves-effect"
                                                                    data-dismiss="modal">بستن
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            {{-- <div class="container-fluid">
                <div class="row clearfix">
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
                                                <span style=" font-size: 1rem">{{ $v2 }}</span> -- <span>
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

                                            </span>
                                            </td>
                                            </span>
                                            <h5 class="mt-5"><a href="#">توسط {{ $action->user->name }} </a>
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
            </div> --}}
            <!-- پایان لیست -->
        </div>
    </div>
</section>
@push('styles')
    <!-- تاریخ -->
    <link rel="stylesheet" type="text/css"
        href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css" />
    <!-- تاریخ پایان-->
@endpush
@push('scripts')
    <script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
    <script>
        $('.scroll').click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });

        let dateTimePicker = {
            from: null,
            to: null
        }

        function destroyDatePicker(type) {
            console.log(dateTimePicker);
            if (type === 'from') {
                $(`#startDate`).val(null);
                $(`#startDate-alt`).val(null);
                dateTimePicker.from.touched = false;
                dateTimePicker.to.options = {
                    initialValue: false
                }
                @this.set(`start_date`, null, true);
            } else {
                $(`#endDate`).val(null);
                $(`#endDate-alt`).val(null);
                dateTimePicker.to.touched = false;
                dateTimePicker.from.options = {
                    maxDate: null,
                    initialValue: false
                }
                @this.set(`end_date`, null, true);
            }
        }

        Livewire.on('destroy-date-picker', () => {
            destroyDatePicker('from', dateTimePicker);
        });
        Livewire.on('destroy-date-picker', () => {
            destroyDatePicker('to', dateTimePicker);
        });

        Livewire.on('edit-action', (data) => {
            //change start and end date time to unix for read in persian date
            let s_string = data.start_date.split(' ');
            let s_date = s_string[0].split('/');
            let s_time = s_string[1].split(':');
            let s_dateTime = [...s_date, ...s_time, '0', '0']
            s_dateTime = s_dateTime.map((item, index) => Number(item))
            let s_unix = new persianDate(s_dateTime).valueOf();
            dateTimePicker.from.setDate(s_unix)

            let e_string = data.end_date.split(' ');
            let e_date = e_string[0].split('/');
            let e_time = e_string[1].split(':');
            let e_dateTime = [...e_date, ...e_time, '0', '0']
            e_dateTime = e_dateTime.map((item, index) => Number(item))
            let e_unix = new persianDate(e_dateTime).valueOf();
            dateTimePicker.to.setDate(e_unix)
        });

        $(document).ready(function() {
            dateTimePicker.from = $(`#startDate`).pDatepicker({
                initialValue: false,
                initialValueType: 'persian',
                format: 'LLLL',
                altField: `#startDate-alt`,
                altFormat: 'g',
                timePicker: {
                    enabled: true,
                    second: {
                        enabled: false
                    },
                },
                altFieldFormatter: function(unixDate) {
                    var self = this;
                    var thisAltFormat = self.altFormat.toLowerCase();
                    if (thisAltFormat === 'gregorian' || thisAltFormat === 'g') {
                        persianDate.toLocale('en');
                        let p = new persianDate(unixDate).format(
                            'YYYY/MM/DD HH:mm');
                        return p;
                    }
                    if (thisAltFormat === 'unix' || thisAltFormat === 'u') {
                        return unixDate;
                    } else {
                        let pd = new persianDate(unixDate);
                        pd.formatPersian = this.persianDigit;
                        return pd.format(self.altFormat);
                    }
                },
                onSelect: function(unix) {
                    dateTimePicker.from.touched = true;
                    if (dateTimePicker.to && dateTimePicker.to.options && dateTimePicker.to.options.minDate != unix) {
                        let cachedValue = dateTimePicker.to.getState().selected.unixDate;
                        dateTimePicker.to.options = {
                            minDate: unix
                        };
                        if (dateTimePicker.to.touched) {
                            dateTimePicker.to.setDate(cachedValue);
                        }
                    }
                    @this.set(`start_date`, $(`#startDate-alt`).val(), true);
                },
            });

            dateTimePicker.to = $(`#endDate`).pDatepicker({
                initialValue: false,
                initialValueType: 'persian',
                format: 'LLLL',
                altField: `#endDate-alt`,
                altFormat: 'g',
                timePicker: {
                    enabled: true,
                    second: {
                        enabled: false
                    },
                },
                altFieldFormatter: function(unixDate) {
                    var self = this;
                    var thisAltFormat = self.altFormat.toLowerCase();
                    if (thisAltFormat === 'gregorian' || thisAltFormat === 'g') {
                        persianDate.toLocale('en');
                        let p = new persianDate(unixDate).format(
                            'YYYY/MM/DD HH:mm');
                        return p;
                    }
                    if (thisAltFormat === 'unix' || thisAltFormat === 'u') {
                        return unixDate;
                    } else {
                        let pd = new persianDate(unixDate);
                        pd.formatPersian = this.persianDigit;
                        return pd.format(self.altFormat);
                    }
                },
                onSelect: function(unix) {
                    dateTimePicker.to.touched = true;
                    if (dateTimePicker.from && dateTimePicker.from.options && dateTimePicker.from
                        .options.maxDate != unix) {
                        let cachedValue = dateTimePicker.from.getState().selected.unixDate;
                        dateTimePicker.from.options = {
                            maxDate: unix
                        };
                        if (dateTimePicker.from.touched) {
                            dateTimePicker.from.setDate(cachedValue);
                        }
                    }
                    @this.set(`end_date`, $(`#endDate-alt`).val(), true);
                },
            });
        });
    </script>
@endpush
