@section('title', 'ایجاد پرونده')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>ثبت پرونده</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href={{ route('admin.devices.index') }}> پرونده ها </a>
                        </li>
                        <li class="breadcrumb-item active">ثبت پرونده ها</li>
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
        @if ($errors->any())
            @foreach ($errors as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <div class="container-fluid">
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="header p-0">
                                <h2><strong>اطلاعات اصلی پرونده</strong></h2>
                            </div>
                            <hr>
                            <div class="row clearfix">
                                <div class="form-group col-sm-3">
                                    <label>نام پرونده یا کیس <abbr class="required text-danger"
                                                                   title="ضروری">*</abbr></label>
                                    <input type="text" wire:model.defer="name"
                                           class="form-control @error('name') is-invalid @enderror" required/>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label>موضوع <abbr class="required text-danger" title="ضروری">*</abbr></label>
                                    <input type="text" wire:model.defer="subject" id="subject"
                                           class="form-control @error('subject') is-invalid @enderror" required/>
                                    <span id="subject-display" class="text-warning"></span>
                                    @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label> شماره پرونده <abbr class="required text-danger" title="ضروری">*</abbr>
                                    </label>
                                    <input type="text" wire:model.defer="number_dossier" id="number_dossier"
                                           class="form-control @error('number_dossier') is-invalid @enderror" required/>
                                    <span id="number_dossier-display" class="text-warning"></span>
                                    @error('number_dossier')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3 col-sm-3 @error('dossier_type') is-invalid @enderror">
                                    <label for="dossier-type">نوع پرونده</label>
                                    <div wire:ignore>
                                        <select id="dossier-type" data-placeholder="انتخاب وضعیت" name="dossier_type"
                                                class="form-control ms select2">
                                            <option value="0" selected>عملیاتی</option>
                                            <option value="1">فاوایی</option>
                                        </select>
                                    </div>
                                    @error('dossier_type')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3 col-sm-3 @error('section_id') is-invalid @enderror">
                                    <label for="sectionSelect">مدیریت یا معاونت <abbr class="required text-danger"
                                                                                      title="ضروری">*</abbr></label>
                                    <div wire:ignore>
                                        <select id="sectionSelect" name="section_id"
                                                data-placeholder="انتخاب مدیریت یا معاونت "
                                                class="form-control ms search-select">
                                            <option></option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}">
                                                    {{ $section->name }} - {{ $section->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('section_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3 col-sm-3 @error('zone_id') is-invalid @enderror">
                                    <label for="zoneSelect">حوزه اقدام <abbr class="required text-danger" title="ضروری">*</abbr></label>
                                    <div wire:ignore>
                                        <select id="zoneSelect" name="zone_id" data-placeholder="انتخاب حوزه اقدام "
                                                class="form-control ms search-select">
                                            <option></option>
                                            @foreach ($zones as $zone)
                                                <option value="{{ $zone->id }}">
                                                    {{ $zone->title }} - {{ $zone->country }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('zone_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3 col-sm-3 @error('country') is-invalid @enderror">
                                    <label for="countrySelect">کشور <abbr class="required text-danger"
                                                                          title="ضروری">*</abbr></label>
                                    <div wire:ignore>
                                        <select id="countrySelect" name="country" data-placeholder="انتخاب کشور"
                                                class="form-control ms search-select">
                                            <option></option>
                                            @foreach ($lists_country as $list_country)
                                                <option value="{{ $list_country[2] }}">
                                                    {{ $list_country[2] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('country')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                @if(!auth()->user()->hasRole('company'))
                                    <div
                                        class="form-group col-md-3 col-sm-3 @error('user_category_id') is-invalid @enderror">
                                        <label for="userSelect">رده <abbr class="required text-danger"
                                                                          title="ضروری">*</abbr></label>
                                        <div wire:ignore>
                                            <select id="userSelect" name="user_category_id"
                                                    data-placeholder="انتخاب رده"
                                                    class="form-control ms search-select">
                                                <option></option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">
                                                        {{ $user->name }} - {{ $user->cellphone }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('user_category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                @endif

                                @if(is_null(auth()->user()->laboratory_id))
                                    @php($laboratories=\App\Models\Laboratory::all())
                                    <div
                                        class="form-group col-md-3 col-sm-3 @if($errors->has('laboratory_id')||$errors->has('laboratory_id.*')) is-invalid @endif">
                                        <label for="laboratorySelect">آزمایشگاه <abbr class="text-danger"
                                                                                title="ضروری">*</abbr></label>
                                        <div wire:ignore>
                                            <select id="laboratorySelect" name="laboratory_id"
                                                    data-placeholder="انتخاب آزمایشگاه" multiple
                                                    class="form-control ms select2" data-close-on-select="false">
                                                @foreach ($laboratories as $laboratory)
                                                    <option value={{ $laboratory->id }}>
                                                        {{ $laboratory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('laboratory_id')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        @error('laboratory_id.*')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                @endif
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
                                <div class="form-group col-md-12 @error('summary_description') is-invalid @enderror">
                                    <label for="summernote">خلاصه پرونده <abbr class="required text-danger"
                                                                               title="ضروری">*</abbr></label>
                                    <div wire:ignore>
                                        <textarea class="form-control summernote-editor" id="summernote"></textarea>
                                    </div>
                                    @error('summary_description')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="header p-0">
                                <h2><strong>اطلاعات کارشناس پرونده</strong></h2>
                            </div>
                            <hr>
                            <div class="row clearfix">
                                <div class="form-group col-md-4">
                                    <label> کارشناس پرونده <abbr class="required text-danger" title="ضروری">*</abbr>
                                    </label>
                                    <input type="text" wire:model.defer="dossier_case" id="dossier_case"
                                           class="form-control @error('dossier_case') is-invalid @enderror"
                                           required/>
                                    <span id="dossier_case-display" class="text-warning"></span>
                                    @error('dossier_case')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label> شماره همراه کارشناس پرونده <abbr class="required text-danger"
                                                                             title="ضروری">*</abbr>
                                    </label>
                                    <input type="text" wire:model.defer="expert_phone" id="expert_phone"
                                           class="form-control @error('expert_phone') is-invalid @enderror"
                                           required/>
                                    <span id="expert-number-display" class="text-warning"></span>
                                    @error('expert_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label>شماره داخلی کارشناس پرونده<abbr class="required text-danger"
                                                                           title="ضروری">*</abbr>
                                    </label>
                                    <input type="text" wire:model.defer="expert_cellphone" id="expert_cellphone"
                                           class="form-control @error('expert_cellphone') is-invalid @enderror"
                                           required/>
                                    <span id="expert_cellphone-display" class="text-warning"></span>
                                    @error('expert_cellphone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12 @error('expert') is-invalid @enderror">
                                    <label>درخواست کارشناس پرونده از آزمایشگاه <abbr class="required text-danger"
                                                                                     title="ضروری">*</abbr></label>
                                    <div>
                                            <textarea class="form-control" rows="6"
                                                      wire:model.defer="expert"></textarea>
                                    </div>
                                    @error('expert')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="header p-0">
                                <h2><strong>اطلاعات قضایی</strong></h2>
                            </div>
                            <hr>
                            <div class="row clearfix">
                                <div class="form-group col-md-6">
                                    <label> شماره حکم قضایی</label>
                                    <input type="text" wire:model.defer="Judicial_number" id="delivery-name"
                                           class="form-control @error('Judicial_number') is-invalid @enderror"/>
                                    @error('Judicial_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label>تاریخ حکم قضایی</label>
                                    <div class="input-group" wire:ignore>
                                        <div class="input-group-prepend" onclick="$('#JudicialDate').focus();">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="zmdi zmdi-calendar-alt"></i></span>
                                        </div>
                                        <input type="hidden" id="JudicialDate-alt" name="Judicial_date">
                                        <input type="text" class="form-control" id="JudicialDate"
                                               value="{{ $Judicial_date ?? null }}" autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1" style="cursor: pointer;"
                                                  onclick="destroyDatePicker()"><i class="zmdi zmdi-close"></i></span>
                                        </div>
                                    </div>
                                    @error('Judicial_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12 @error('Judicial_image') is-invalid @enderror">
                                    <label for="Judicial_image">تصویر حکم قضایی <small>(عکس با فرمت jpg و
                                            png)</small></label>
                                    <div wire:ignore>
                                        <input wire:model="Judicial_image" id="Judicial_image" type="file"
                                               class="dropify form-control" data-allowed-file-extensions="jpg png"
                                               data-max-file-size="10M">
                                    </div>
                                    @error('Judicial_image')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-12">
                                    <button wire:click="create(1)" wire:loading.attr="disabled"
                                            class="btn btn-raised btn-success waves-effect"><i wire:loading
                                                                                               class='zmdi zmdi-hc-fw zmdi-hc-spin'></i>
                                        ذخیره
                                    </button>
                                    <button wire:click="create(2)" wire:loading.attr="disabled"
                                            class="btn btn-raised btn-primary waves-effect"><i wire:loading
                                                                                               class='zmdi zmdi-hc-fw zmdi-hc-spin'></i>
                                        ذخیره و مشاهده پرونده
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('styles')
    <link rel=" stylesheet" href={{ asset('assets\admin\css\dropzone.min.css') }} type="text/css"/>
    <!-- تاریخ -->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/date-time-picker/persian-datepicker.min.css')}}"/>
    <style>
        .dropzone {
            border-radius: 5px;
            border-style: solid !important;
            border-width: 2px !important;
            border-color: #D2D5D6 !important;
            background-color: white !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{asset('vendor/date-time-picker/persian-date.min.js')}}"></script>
    <script src="{{asset('vendor/date-time-picker/persian-datepicker.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#laboratorySelect').on('change', function (e) {
                let data = $('#laboratorySelect').select2("val");
                if (data === '') {
                @this.set('laboratory_id', null)
                    ;
                } else {
                @this.set('laboratory_id', data)
                    ;
                }
            });

            $('#is_active').on('change', function (e) {
                let data = $('#is_active').select2("val");
            @this.set('is_active', data)
                ;
            });
            $('#dossier-type').on('change', function (e) {
                let data = $('#dossier-type').select2("val");
            @this.set('dossier_type', data)
                ;
            });

            $('#userSelect').on('change', function (e) {
                let data = $('#userSelect').select2("val");
                if (data === '') {
                @this.set('user_category_id', null)
                    ;
                } else {
                @this.set('user_category_id', data)
                    ;
                }
            });
            $('#zoneSelect').on('change', function (e) {
                let data = $('#zoneSelect').select2("val");
                if (data === '') {
                @this.set('zone_id', null)
                    ;
                } else {
                @this.set('zone_id', data)
                    ;
                }
            });
            $('#countrySelect').on('change', function (e) {
                let data = $('#countrySelect').select2("val");
                if (data === '') {
                @this.set('country', null)
                    ;
                } else {
                @this.set('country', data)
                    ;
                }
            });

            $('#sectionSelect').on('change', function (e) {
                let data = $('#sectionSelect').select2("val");
                if (data === '') {
                @this.set('section_id', null)
                    ;
                } else {
                @this.set('section_id', data)
                    ;
                }
            });

            $('#summernote').on('summernote.change', function (we, contents, $editable) {
            @this.set('summary_description', contents)
                ;
            });
        });
    </script>
    {{-- دیتا پیکر --}}
    <script>
        let JudicialDate;

        function destroyDatePicker() {
            $(`#JudicialDate`).val(null);
            $(`#JudicialDate-alt`).val(null);
            JudicialDate.touched = false;
            JudicialDate.options = {
                initialValue: false
            }
        @this.set(`Judicial_date`, null, true)
            ;
        }

        $(document).ready(function () {
            JudicialDate = $(`#JudicialDate`).pDatepicker({
                initialValue: false,
                initialValueType: 'persian',
                format: 'L',
                altField: `#JudicialDate-alt`,
                altFormat: 'g',
                altFieldFormatter: function (unixDate) {
                    var self = this;
                    var thisAltFormat = self.altFormat.toLowerCase();
                    if (thisAltFormat === 'gregorian' || thisAltFormat === 'g') {
                        persianDate.toLocale('en');
                        let p = new persianDate(unixDate).format(
                            'YYYY/MM/DD');
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
                @this.set(`Judicial_date`, $(`#JudicialDate-alt`).val(), true)
                    ;
                },
            });
        });
    </script>
@endpush
