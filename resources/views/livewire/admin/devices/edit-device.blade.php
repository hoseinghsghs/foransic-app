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
                                <hr>
                                <div class="row clearfix">
                                    <div
                                        class="form-group col-sm-6 col-sm-6 @error('category_id') is-invalid @enderror">
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
                                    <div class="form-group col-md-3">
                                        <label>تاریخ ثبت </label>
                                        <div class="input-group" wire:ignore>
                                            <div class="input-group-prepend"
                                                 onclick="$('#createDate').focus();">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="zmdi zmdi-calendar-alt"></i></span>
                                            </div>
                                            <input type="hidden" id="createDate-alt"
                                                   name="create_date">
                                            <input type="text" class="form-control" id="createDate"
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
                                    <div class="form-group col-md-3">
                                        <label> مدل<abbr class="required" title="ضروری"
                                                                                         style="color:red;">*</abbr></label>
                                        <div class="form-group">
                                            <input type="text" wire:model.defer="code" id="code"
                                                   class="form-control @error('code') is-invalid @enderror" required/>
                                            <span id="code-display" class="text-warning"></span>
                                            @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3 col-sm-3 @error('status') is-invalid @enderror">
                                        <label for="statusSelect">وضعیت بررسی</label>
                                        <div wire:ignore>
                                            <select id="statusSelect" data-placeholder="انتخاب وضعیت"
                                                    class="form-control ms select2 statusSelect">
                                                <option value="0" @selected($status == '0')>پذیرش شواهد دیجیتال
                                                </option>
                                                <option value="1" @selected($status == '1')>در حال بررسی
                                                </option>
                                                <option value="2" @selected($status == '2')> تکمیل تجزیه و تحلیل
                                                </option>
                                                <option value="3" @selected($status == '3')>تحویل شواهد دیجیتال
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
                                                <div class="form-group">
                                                    <input type="text"
                                                           wire:model="attribute_values.{{ $attribute->id }}"
                                                           id="delivery_code"
                                                           class="form-control @error("attribute_values.{{ $attribute->id }}") is-invalid @enderror"/>
                                                    @error("attribute_values.{{ $attribute->id }}")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    {{-- تحویل گیرنده --}}
                                    @if ($status == '3')
                                        <div class="form-group col-md-6">
                                            <label> نام تحویل گیرنده </label>
                                            <div class="form-group">
                                                <input type="text" wire:model.defer="receiver_name"
                                                       id="receiver-name"
                                                       class="form-control @error('receiver_name') is-invalid @enderror"/>
                                                <span id="receiver-name-display" class="text-warning"></span>
                                                @error('receiver_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label> کد پرسنلی تحویل گیرنده</label>
                                            <div class="form-group">
                                                <input type="text" wire:model.defer="receiver_code"
                                                       id="receiver_code"
                                                       class="form-control @error('receiver_code') is-invalid @enderror"/>
                                                <span id="receiver_code-display" class="text-warning"></span>
                                                @error('receiver_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-md-4 col-sm-4 @error('dossier_id') is-invalid @enderror">
                                        <label for="userSelect">الحاق به پرونده </label>
                                        <div wire:ignore>
                                            <select id="userSelect" name="dossier_id" data-placeholder="انتخاب پرونده"
                                                    class="form-control ms search-select">
                                                <option value=null></option>
                                                @foreach ($dossiers as $dossier)
                                                    <option
                                                        value="{{ $dossier->id }}" @selected($device->dossier_id == $dossier->id)>
                                                        {{ $dossier->name }} - {{ $dossier->number_dossier }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('dossier_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label> نام تحویل دهنده <abbr class="required" title="ضروری"
                                                                      style="color:red;">*</abbr></label>
                                        <div class="form-group">
                                            <input type="text" wire:model.defer="delivery_name" id="delivery-name"
                                                   class="form-control @error('delivery_name') is-invalid @enderror"
                                                   required/>
                                            <span id="delivery-name-display" class="text-warning"></span>

                                            @error('delivery_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label> کد پرسنلی تحویل دهنده</label>
                                        <div class="form-group">
                                            <input type="text" wire:model.defer="delivery_code" id="delivery_code"
                                                   class="form-control @error('delivery_code') is-invalid @enderror"/>
                                            <span id="delivery_code-display" class="text-warning"></span>
                                            @error('delivery_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3 col-auto">
                                        <label for="is_active">وضعیت</label>
                                        <div class="switchToggle">
                                            <input type="checkbox" wire:model="is_active" id="switch">
                                            <label for="switch">Toggle</label>
                                        </div>
                                        @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="form-group col-md-12 @error('trait') is-invalid @enderror">
                                        <label>  توضیحات شواهد </label>
                                        <div>
                                            <textarea class="form-control" rows="6"
                                                      wire:model.defer="trait">{!! $trait !!}</textarea>
                                        </div>
                                        @error('trait')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-md-12 @error('accessories') is-invalid @enderror">
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
                                </div>

                                <div class="row clearfix" wire:ignore>
                                    <div class="form-group col-md-12 @error('description') is-invalid @enderror">
                                        <label for="summernote-2">توضیحات و اظهارات درخواست کننده :</label>
                                        <div>
                                            <textarea class="form-control summernote-editor" wire:model.defer="description" rows="5" id="summernote-2">
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
                                    <div class="form-group col-md-12 @error('report') is-invalid @enderror">
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
                                </div>
                                <div class="body">
                                    <p>فایل گزارش نهایی</p>
                                    <div class="form-group" wire:ignore>
                                        <input type="file" class="dropify" name="attachment_report"
                                               id="attachment_report" wire:model="attachment_report"
                                               data-max-file-size="40M"
                                               value={{ $device->attachment_report ? url(env('ATTACHMENT_REPORT_UPLOAD_PATCH') . $device->attachment_report) : null}}
                                            data-default-file={{ $device->attachment_report ? url(env('ATTACHMENT_REPORT_UPLOAD_PATCH') . $device->attachment_report) : null}}
                                            data-allowed-file-extensions="docx xlsx pdf csv zip rar">
                                    </div>
                                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <div wire:loading wire:target="attachment_report" class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%"></div>
                                    </div>
                                    @isset($device->attachment_report)
                                        لینک دانلود :
                                        <a
                                            href={{ url(env('ATTACHMENT_REPORT_UPLOAD_PATCH') . $device->attachment_report) }}>{{ $device->attachment_report }}</a>
                                    @endisset
                                </div>

                                <div class="header p-0 mt-3">
                                    <h2><strong>مشخصات مکاتبه</strong></h2>
                                </div>
                                <hr>
                                <div class="row clearfix">
                                    <div class="form-group col-md-6">
                                        <label> شماره خودکار ساز نامه درخواست</label>
                                        <div class="form-group">
                                            <input type="text" wire:model.defer="correspondence_number"
                                                   id="correspondence_number"
                                                   class="form-control @error('correspondence_number') is-invalid @enderror"/>
                                            <span id="correspondence_number-display" class="text-warning"></span>
                                            @error('correspondence_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                                </div>
                                <div class="col-12">
                                    <button type="submit" wire:loading.attr="disabled"
                                            class="btn btn-raised btn-success waves-effect"><i wire:loading wire:loading wire:target="attachment_report"
                                                                                               class='zmdi zmdi-hc-fw zmdi-hc-spin'></i>
                                        ذخیره
                                    </button>
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
    <link rel="stylesheet" type="text/css"
          href="{{asset('vendor/date-time-picker/persian-datepicker.min.css')}}"/>
@endpush
@push('scripts')
    <script src="{{asset('vendor/date-time-picker/persian-date.min.js')}}"></script>
    <script src="{{asset('vendor/date-time-picker//persian-datepicker.min.js')}}"></script>
    <!-- dropzone script start -->
    <script>
        let correspondenceDate;
        let createDate;

        function destroyDatePicker() {
            $(`#correspondenceDate`).val(null);
            $(`#correspondenceDate-alt`).val(null);
            correspondenceDate.touched = false;
            correspondenceDate.options = {
                initialValue: false
            }
        @this.set(`correspondence_date`, null, true);
        }

        function destroyDatePicker2() {
            $(`#createDate`).val(null);
            $(`#createDate-alt`).val(null);
            createDate.touched = false;
            createDate.options = {
                initialValue: false
            }
        @this.set(`receive_date`, null, true);
        }

        $(document).ready(function () {
            $('#statusSelect').on('change', function (e) {
                let data = $('#statusSelect').select2("val");
            @this.set('status', data);
            });

            $('#title-device').on('change', function (e) {
                let data = $('#title-device').select2("val");
            @this.set('category_id', data);
            });

            $('#userSelect').on('change', function (e) {
                let data = $('#userSelect').select2("val");
                if (data === null) {
                @this.set('dossier_id', null);
                } else {
                @this.set('dossier_id', data);
                }
            });
            $('#summernote').on('summernote.change', function (we, contents, $editable) {
            @this.set('report', contents);
            });
            $('#summernote-2').on('summernote.change', function (we, contents, $editable) {
            @this.set('description', contents);
            });
            // date time picker
            correspondenceDate = $(`#correspondenceDate`).pDatepicker({
                initialValue: "{{ $correspondence_date ? true : false }}",
                initialValueType: 'persian',
                format: 'L',
                altField: `#correspondenceDate-alt`,
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
                @this.set(`correspondence_date`, $(`#correspondenceDate-alt`).val(), true);
                },
            });

            createDate = $(`#createDate`).pDatepicker({
                initialValue: "{{ $receive_date ? true : false }}",
                initialValueType: 'persian',
                format: 'L',
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
                @this.set(`receive_date`, $(`#createDate-alt`).val(), true);
                },
            });
        });
    </script>
@endpush
