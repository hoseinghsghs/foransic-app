@section('title', 'ویرایش شواهد دیجیتال')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>ویرایش شواهد دیجیتال</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href={{ route('admin.devices.index') }}>لیست شواهد دیجیتال
                                ها </a>
                        </li>
                        <li class="breadcrumb-item active">ویرایش شواهد دیجیتال</li>
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
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <form wire:submit.prevent="edit">
                                <div class="header p-0">
                                    <h2><strong>اطلاعات اصلی شواهد دیجیتال</strong></h2>
                                </div>
                                <hr/>
                                <div class="row clearfix">
                                    <div class="form-group col-md-6 col-lg-4 @error('category_id') is-invalid @enderror">
                                        <label for="title-device">انتخاب شواهد دیجیتال <abbr class="required"
                                                                                             title="ضروری"
                                                                                             style="color:red;">*</abbr></label>
                                        <div wire:ignore>
                                            <select id="title-device" name="title_managements_id"
                                                    data-placeholder="انتخاب دسته بندی" required
                                                    class="form-control ms search-select">
                                                <option></option>
                                                @foreach ($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}" @selected($device->category->id == $category->id)>
                                                        {{ $category->title }} - {{ $category->id }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-3">
                                        <label>زمان پذیرش </label>
                                        <div class="input-group" wire:ignore>
                                            <div class="input-group-prepend" onclick="$('#createDate').focus();">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="zmdi zmdi-calendar-alt"></i></span>
                                            </div>
                                            <input type="hidden" id="createDate-alt" name="create_date">
                                            <input type="text" class="form-control" id="createDate" dir="ltr"
                                                   value="{{ $receive_date ?? null }}" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon1"
                                                      style="cursor: pointer;" onclick="destroyDatePicker2()"><i
                                                        class="zmdi zmdi-close"></i></span>
                                            </div>
                                        </div>
                                        @error('receive_date')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4 col-lg-3">
                                        <label> مدل<abbr class="required" title="ضروری"
                                                         style="color:red;">*</abbr></label>
                                        <input type="text" wire:model.defer="code" id="code"
                                               class="form-control @error('code') is-invalid @enderror" required/>
                                        <span id="code-display" class="text-warning"></span>
                                        @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-auto">
                                        <label for="is_active">وضعیت</label>
                                        <div class="switchToggle">
                                            <input type="checkbox" wire:model="is_active" id="switch">
                                            <label for="switch">Toggle</label>
                                        </div>
                                        @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3 col-sm-3 @error('status') is-invalid @enderror">
                                        <label for="statusSelect">وضعیت بررسی</label>
                                        <div wire:ignore>
                                            <select id="statusSelect" data-placeholder="انتخاب وضعیت"
                                                    class="form-control ms select2 statusSelect">
                                                <option value="0" @selected($status=='0' )>پذیرش شواهد دیجیتال
                                                </option>
                                                <option value="1" @selected($status=='1' )>در حال بررسی
                                                </option>
                                                <option value="2" @selected($status=='2' )> تکمیل تجزیه و تحلیل
                                                </option>
                                                <option value="3" @selected($status=='3' )>خروج شواهد دیجیتال
                                                </option>
                                            </select>
                                        </div>
                                        @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    {{-- category attributes --}}
                                    @if ($category_id && $this->category->attributes()->exists())
                                        @foreach ($this->category->attributes as $attribute)
                                            <div class="form-group col-md-3" wire:key="{{ $attribute->id }}">
                                                <label>{{ $attribute->name }}</label>
                                                @if ($attribute->def_values)
                                                    <select id="valueSelect"
                                                            wire:model="attribute_values.{{ $attribute->id }}"
                                                            data-placeholder="انتخاب"
                                                            class="form-control @error(" attribute_values.{{ $attribute->id }}") is-invalid @enderror">
                                                        <option value=null>انتخاب کنید</option>
                                                        @foreach (json_decode($attribute->def_values, true) as $def_valuee)
                                                            <option value="{{$def_valuee}}">
                                                                {{ $def_valuee }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <input type="text"
                                                           wire:model="attribute_values.{{ $attribute->id }}"
                                                           id="delivery_code"
                                                           class="form-control @error(" attribute_values.{{ $attribute->id }}") is-invalid @enderror"/>
                                                    @error("attribute_values.{{ $attribute->id }}")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                {{-- تحویل گیرنده --}}
                                <div @class(['row clearfix d-none','d-inline'=>$status =='3'])>
                                    <div class="form-group col-md-4">
                                        <label> نام تحویل گیرنده </label>
                                        <input type="text" wire:model.defer="receiver_name" id="receiver-name"
                                               class="form-control @error('receiver_name') is-invalid @enderror"/>
                                        <span id="receiver-name-display" class="text-warning"></span>
                                        @error('receiver_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label> کد پرسنلی تحویل گیرنده</label>
                                        <input type="text" wire:model.defer="receiver_code" id="receiver_code"
                                               class="form-control @error('receiver_code') is-invalid @enderror"/>
                                        <span id="receiver_code-display" class="text-warning"></span>
                                        @error('receiver_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>زمان تحویل </label>
                                        <div class="input-group" wire:ignore>
                                            <div class="input-group-prepend" onclick="$('#deliver-date').focus();">
                                                        <span class="input-group-text" id="basic-addon1"><i
                                                                class="zmdi zmdi-calendar-alt"></i></span>
                                            </div>
                                            <input type="hidden" id="deliver-date-alt" name="create_date">
                                            <input type="text" class="form-control" id="deliver-date" dir="ltr"
                                                   value="{{ $delivery_date ?? null }}" autocomplete="off">
                                            <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon1"
                                                              style="cursor: pointer;"
                                                              onclick="destroyDeliveryDate()"><i
                                                                class="zmdi zmdi-close"></i></span>
                                            </div>
                                        </div>
                                        @error('delivery_date')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div
                                        class="form-group col-md-6 col-lg-3 @error('dossier_id') is-invalid @enderror">
                                        <label for="userSelect">الحاق به پرونده </label>
                                        <div wire:ignore>
                                            <select id="userSelect" name="dossier_id"
                                                    data-placeholder="انتخاب پرونده"
                                                    class="form-control ms search-select">
                                                <option value=null></option>
                                                @foreach ($dossiers as $dossier)
                                                    <option
                                                        value="{{ $dossier->id }}" @selected($device->dossier_id == $dossier->id)>
                                                        {{ $dossier->name }} - {{ $dossier->number_dossier }}
                                                        -{{$dossier->company->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('dossier_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    @isset($dossier_id)
                                            <?php
                                            $parent_devices = $parent_devices->where('dossier_id', $dossier_id);
                                            ?>
                                        @if ($parent_devices->count())
                                            <div
                                                class="form-group col-md-6 col-lg-3 @error('parent_id') is-invalid @enderror">
                                                <label for="rel"> ارتباط با سایر شواهد<abbr class="required"
                                                                                            title="ضروری"
                                                                                            style="color:red;">*</abbr></label>
                                                <div>
                                                    <select id="rel" name="parent_id"
                                                            data-placeholder="انتخاب پرونده"
                                                            wire:model.defer="parent_id"
                                                            class="form-control ms search-select">
                                                        <option value=0 @selected($device->parent_id == 0)>شاهد اصلی
                                                        </option>
                                                        @foreach ($parent_devices as $parent_device)
                                                            <option
                                                                value="{{ $parent_device->id }}" @selected($device->parent_id == $parent_device->id) @disabled($device->id==$parent_device->id) >
                                                                آی دی: {{ $parent_device->id  }} -
                                                                عنوان: {{ $parent_device->category->title}} -
                                                                مدل: {{ $parent_device->code  }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('parent_id')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        @endif
                                    @endisset

                                    <div class="form-group col-md-6 col-lg-3">
                                        <label> نام تحویل دهنده <abbr class="required" title="ضروری"
                                                                      style="color:red;">*</abbr></label>
                                        <input type="text" wire:model.defer="delivery_name" id="delivery-name"
                                               class="form-control @error('delivery_name') is-invalid @enderror"
                                               required/>
                                        <span id="delivery-name-display" class="text-warning"></span>

                                        @error('delivery_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 col-lg-3">
                                        <label> کد پرسنلی تحویل دهنده</label>
                                        <input type="text" wire:model.defer="delivery_code" id="delivery_code"
                                               class="form-control @error('delivery_code') is-invalid @enderror"/>
                                        <span id="delivery_code-display" class="text-warning"></span>
                                        @error('delivery_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="form-group col-lg-6 col-12 @error('trait') is-invalid @enderror">
                                        <label> توضیحات شواهد </label>
                                        <div>
                                                <textarea class="form-control" rows="6"
                                                          wire:model.defer="trait">{!! $trait !!}</textarea>
                                        </div>
                                        @error('trait')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div
                                        class="form-group col-lg-6 col-12 @error('accessories') is-invalid @enderror">
                                        <label> لوازم جانبی</label>
                                        <div>
                                                <textarea class="form-control" rows="6" wire:model.defer="accessories">
                                            {!! $accessories !!}
                                        </textarea>
                                        </div>
                                        @error('accessories')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group col-12 @error('description') is-invalid @enderror">
                                        <label for="summernote-2">تجربه نگاری کارشناس فارنزیک در اقدامات :</label>
                                        <div wire:ignore>
                                                <textarea class="form-control summernote-editor"
                                                          wire:model.defer="description" rows="5" id="summernote-2">
                                            {!! $description !!}
                                        </textarea>
                                        </div>
                                        @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="header">
                                    <strong style="color:#e47297 !important">تجزیه و تحلیل نهایی</strong>
                                    <button wire:click="printReport()" type="button" wire:loading.attr="disabled"
                                            style="float: left" class="btn btn-raised btn-warning waves-effect"><i
                                            wire:loading class='zmdi zmdi-hc-fw zmdi-hc-spin'></i>
                                        پرینت گزارش نهایی
                                    </button>
                                </div>
                                <hr>
                                <div class="row clearfix" wire:ignore>
                                    <div class="form-group col-lg-6 col-12 @error('report') is-invalid @enderror">
                                        <label for="summernote">گزارش تجزیه تحلیل نهایی </label>
                                        <div>
                                                <textarea class="form-control summernote-editor" rows="6"
                                                          wire:model.defer="report"
                                                          id="summernote">{!! $report !!}</textarea>
                                        </div>
                                        @error('report')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <p>فایل گزارش نهایی</p>
                                        <div class="form-group" wire:ignore>
                                            <input type="file" class="dropify" name="attachment_report"
                                                   id="attachment_report" wire:model="attachment_report"
                                                   data-max-file-size="40M"
                                                   value={{ $device->attachment_report ? url(env('ATTACHMENT_REPORT_UPLOAD_PATCH') . $device->attachment_report) : null}} data-default-file={{ $device->attachment_report ? url(env('ATTACHMENT_REPORT_UPLOAD_PATCH') . $device->attachment_report) : null}} data-allowed-file-extensions="docx
                                                   xlsx pdf csv zip rar">
                                        </div>
                                        <div class="progress" role="progressbar"
                                             aria-label="Animated striped example"
                                             aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                            <div wire:loading wire:target="attachment_report"
                                                 class="progress-bar progress-bar-striped progress-bar-animated"
                                                 style="width: 100%"></div>
                                        </div>
                                        @isset($device->attachment_report)
                                            لینک دانلود :
                                            <a href={{ url(env('ATTACHMENT_REPORT_UPLOAD_PATCH') . $device->attachment_report) }}>{{ $device->attachment_report }}</a>
                                        @endisset
                                    </div>
                                </div>

                                <div class="header p-0 mt-3">
                                    <h2><strong>مشخصات مکاتبه</strong></h2>
                                </div>
                                <hr>
                                <div class="row clearfix">
                                    <div class="form-group col-md-3">
                                        <label> شماره خودکار ساز نامه درخواست</label>
                                        <input type="text" wire:model.defer="correspondence_number"
                                               id="correspondence_number"
                                               class="form-control @error('correspondence_number') is-invalid @enderror"/>
                                        <span id="correspondence_number-display" class="text-warning"></span>
                                        @error('correspondence_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>تاریخ مکاتبه </label>
                                        <div class="input-group" wire:ignore>
                                            <div class="input-group-prepend"
                                                 onclick="$('#correspondenceDate').focus();">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="zmdi zmdi-calendar-alt"></i></span>
                                            </div>
                                            <input type="hidden" id="correspondenceDate-alt"
                                                   name="correspondence_date">
                                            <input type="text" class="form-control" id="correspondenceDate"
                                                   dir="ltr"
                                                   value="{{ $correspondence_date ?? null }}" autocomplete="off">
                                            <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon1"
                                                          style="cursor: pointer;" onclick="destroyDatePicker()"><i
                                                            class="zmdi zmdi-close"></i></span>
                                            </div>
                                        </div>
                                        @error('correspondence_date')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label> شماره خودکار ساز نامه پاسخ</label>
                                        <input type="text" wire:model.defer="reply_correspondence_number"
                                               id="reply_correspondence_number"
                                               class="form-control @error('reply_correspondence_number') is-invalid @enderror"/>
                                        <span id="reply_correspondence_number-display" class="text-warning"></span>
                                        @error('reply_correspondence_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>تاریخ مکاتبه پاسخ </label>
                                        <div class="input-group" wire:ignore>
                                            <div class="input-group-prepend"
                                                 onclick="$('#reply_correspondenceDate').focus();">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="zmdi zmdi-calendar-alt"></i></span>
                                            </div>
                                            <input type="hidden" id="reply_correspondenceDate-alt"
                                                   name="reply_correspondence_date">
                                            <input type="text" class="form-control" id="reply_correspondenceDate"
                                                   dir="ltr" value="{{ $reply_correspondence_date ?? null }}"
                                                   autocomplete="off">
                                            <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon1"
                                                          style="cursor: pointer;" onclick="destroyDatePicker3()"><i
                                                            class="zmdi zmdi-close"></i></span>
                                            </div>
                                        </div>
                                        @error('reply_correspondence_date')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" wire:loading.attr="disabled"
                                                class="btn btn-raised btn-success waves-effect"><i wire:loading
                                                                                                   wire:loading
                                                                                                   wire:target="attachment_report"
                                                                                                   class='zmdi zmdi-hc-fw zmdi-hc-spin'></i>
                                            ذخیره
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/date-time-picker/persian-datepicker.min.css')}}"/>
@endpush
@push('scripts')
    <script src="{{asset('vendor/date-time-picker/persian-date.min.js')}}"></script>
    <script src="{{asset('vendor/date-time-picker//persian-datepicker.min.js')}}"></script>
    <!-- dropzone script start -->
    <script>
        let correspondenceDate;
        let reply_correspondenceDate;
        let createDate;
        let deliverDate;

        function destroyDatePicker() {
            $(`#correspondenceDate`).val(null);
            $(`#correspondenceDate-alt`).val(null);
            correspondenceDate.touched = false;
            correspondenceDate.options = {
                initialValue: false
            }
        @this.set(`correspondence_date`, null, true)
            ;
        }

        function destroyDatePicker2() {
            $(`#createDate`).val(null);
            $(`#createDate-alt`).val(null);
            createDate.touched = false;
            createDate.options = {
                initialValue: false
            }
        @this.set(`receive_date`, null, true)
            ;
        }

        function destroyDatePicker3() {
            $(`#reply_correspondenceDate`).val(null);
            $(`#reply_correspondenceDate-alt`).val(null);
            reply_correspondenceDate.touched = false;
            reply_correspondenceDate.options = {
                initialValue: false
            }
        @this.set(`reply_correspondence_date`, null, true)
            ;
        }

        function destroyDeliveryDate() {
            $(`#deliver-date`).val(null);
            $(`#deliver-date-alt`).val(null);
            deliverDate.touched = false;
            deliverDate.options = {
                initialValue: false
            }
        @this.set(`delivery_date`, null, true)
            ;
        }

        $(document).ready(function () {
            $('#statusSelect').on('change', function (e) {
                let data = $('#statusSelect').select2("val");
            @this.set('status', data)
                ;
            });

            $('#title-device').on('change', function (e) {
                let data = $('#title-device').select2("val");
            @this.set('category_id', data)
                ;
            });

            $('#userSelect').on('change', function (e) {
                let data = $('#userSelect').select2("val");
                if (data === null) {
                @this.set('dossier_id', null)
                    ;
                } else {
                @this.set('dossier_id', data)
                    ;
                }
            });
            $('#rel').on('change', function (e) {
                let data = $('#rel').select2("val");
                if (data === '') {
                @this.set('parent_id', 0)
                    ;
                } else {
                @this.set('parent_id', data)
                    ;
                }
            });

            $('#summernote').on('summernote.change', function (we, contents, $editable) {
            @this.set('report', contents)
                ;
            });
            $('#summernote-2').on('summernote.change', function (we, contents, $editable) {
            @this.set('description', contents)
                ;
            });
            // date time picker
            correspondenceDate = $(`#correspondenceDate`).pDatepicker({
                initialValue: "{{ $correspondence_date ? true : false }}",
                initialValueType: 'persian',
                format: 'L',
                altField: `#correspondenceDate-alt`,
                altFormat: 'g',
                altFieldFormatter: function (unixDate) {
                    var self = this;
                    var thisAltFormat = self.altFormat.toLowerCase();
                    if (thisAltFormat === 'gregorian' || thisAltFormat === 'g') {
                        persianDate.toLocale('en');
                        let p = new persianDate(unixDate).format('YYYY/MM/DD');
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
                onSelect: function (unix) {
                @this.set(`correspondence_date`, $(`#correspondenceDate-alt`).val(), true)
                    ;
                },
            });

            reply_correspondenceDate = $(`#reply_correspondenceDate`).pDatepicker({
                initialValue: "{{ $reply_correspondence_date ? true : false }}",
                initialValueType: 'persian',
                format: 'L',
                altField: `#reply_correspondenceDate-alt`,
                altFormat: 'g',
                altFieldFormatter: function (unixDate) {
                    var self = this;
                    var thisAltFormat = self.altFormat.toLowerCase();
                    if (thisAltFormat === 'gregorian' || thisAltFormat === 'g') {
                        persianDate.toLocale('en');
                        let p = new persianDate(unixDate).format('YYYY/MM/DD');
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
                onSelect: function (unix) {
                @this.set(`reply_correspondence_date`, $(`#reply_correspondenceDate-alt`).val(), true)
                    ;
                },
            });

            createDate = $(`#createDate`).pDatepicker({
                initialValue: "{{ $receive_date ? true : false }}",
                initialValueType: 'persian',
                format: 'YYYY/MM/DD HH:mm',
                altField: `#createDate-alt`,
                altFormat: 'g',
                timePicker: {
                    enabled: true,
                    second: {
                        enabled: false
                    },
                },
                altFieldFormatter: function (unixDate) {
                    var self = this;
                    var thisAltFormat = self.altFormat.toLowerCase();
                    if (thisAltFormat === 'gregorian' || thisAltFormat === 'g') {
                        persianDate.toLocale('en');
                        let p = new persianDate(unixDate).format('YYYY/MM/DD HH:mm');
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
                onSelect: function (unix) {
                @this.set(`receive_date`, $(`#createDate-alt`).val(), true)
                    ;
                },
            });
            //change receive date time to unix for read in persian date
            if ("{!! $receive_date !!}") {
                let date = "{!! $receive_date !!}";
                let s_string = date.split(' ');
                let s_date = s_string[0].split('/');
                let s_time = s_string[1].split(':');
                let s_dateTime = [...s_date, ...s_time, '0', '0'];
                s_dateTime = s_dateTime.map((item, index) => Number(item));
                let s_unix = new persianDate(s_dateTime).valueOf();
                createDate.setDate(s_unix);
            }

            deliverDate = $(`#deliver-date`).pDatepicker({
                initialValue: "{{ $delivery_date ? true : false }}",
                initialValueType: 'persian',
                format: 'YYYY/MM/DD HH:mm',
                altField: `#deliver-date-alt`,
                altFormat: 'g',
                timePicker: {
                    enabled: true,
                    second: {
                        enabled: false
                    },
                },
                altFieldFormatter: function (unixDate) {
                    var self = this;
                    var thisAltFormat = self.altFormat.toLowerCase();
                    if (thisAltFormat === 'gregorian' || thisAltFormat === 'g') {
                        persianDate.toLocale('en');
                        let p = new persianDate(unixDate).format('YYYY/MM/DD HH:mm');
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
                onSelect: function (unix) {
                @this.set(`delivery_date`, $(`#deliver-date-alt`).val(), true)
                    ;
                },
            });

            if ("{!! $delivery_date !!}") {
                let date = "{!! $delivery_date !!}";
                let s_string = date.split(' ');
                let s_date = s_string[0].split('/');
                let s_time = s_string[1].split(':');
                let s_dateTime = [...s_date, ...s_time, '0', '0'];
                s_dateTime = s_dateTime.map((item, index) => Number(item));
                let s_unix = new persianDate(s_dateTime).valueOf();
                deliverDate.setDate(s_unix);
            }

        @this.set(`delivery_date`, $(`#deliver-date-alt`).val(), true)
            ;

        });
    </script>
@endpush
