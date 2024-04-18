@section('title', 'ویرایش پرونده')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>ویرایش پرونده</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href={{ route('admin.devices.index') }}>لیست پرونده ها </a>
                        </li>
                        <li class="breadcrumb-item active">ویرایش پرونده ها</li>
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
                            <div class="header p-0">
                                <h2><strong>اطلاعات اصلی پرونده</strong></h2>
                            </div>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-sm-5">
                                    <label>نام پرونده یا کیس <abbr class="required text-danger"
                                                                   title="ضروری">*</abbr></label>
                                    <div class="form-group">
                                        <input type="text" wire:model.defer="name"
                                               class="form-control @error('name') is-invalid @enderror" required/>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>موضوع <abbr class="required text-danger" title="ضروری">*</abbr></label>
                                    <div class="form-group">
                                        <input type="text" wire:model.defer="subject" id="subject"
                                               class="form-control @error('subject') is-invalid @enderror" required/>
                                        <span id="subject-display" class="text-warning"></span>
                                        @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label> شماره پرونده <abbr class="required text-danger" title="ضروری">*</abbr>
                                    </label>
                                    <div class="form-group">
                                        <input type="text" wire:model.defer="number_dossier" id="number_dossier"
                                               class="form-control @error('number_dossier') is-invalid @enderror"
                                               required/>
                                        <span id="number_dossier-display" class="text-warning"></span>
                                        @error('number_dossier')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-3 col-sm-3 @error('dossier_type') is-invalid @enderror">
                                    <label for="dossier-type">نوع پرونده</label>
                                    <div wire:ignore>
                                        <select id="dossier-type" data-placeholder="انتخاب وضعیت" name="dossier_type"
                                                class="form-control ms select2">
                                            <option value="0" @selected($dossier_type==0) >عملیاتی</option>
                                            <option value="1" @selected($dossier_type==1)>فاوایی</option>
                                        </select>
                                    </div>
                                    @error('dossier_type')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-5">
                                    <label>مدیریت یا معاونت <abbr class="required text-danger" title="ضروری">*</abbr>
                                    </label>
                                    <div class="form-group">
                                        <input type="text" wire:model.defer="section" id="delivery-name"
                                               class="form-control @error('section') is-invalid @enderror" required/>
                                        <span id="delivery-name-display" class="text-warning"></span>
                                        @error('section')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4 col-sm-4 @error('use_id') is-invalid @enderror">
                                    <label for="userSelect">رده</label>
                                    <div wire:ignore>
                                        <select id="userSelect" name="user_category_id" data-placeholder="انتخاب رده"
                                                class="form-control ms search-select">
                                            <option></option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $dossier->user_category_id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->cellphone }} - {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('user_category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
                                <div class="form-group col-md-12 @error('summary_description') is-invalid @enderror">
                                    <label for="summernote">خلاصه پرونده <abbr class="required text-danger"
                                                                               title="ضروری">*</abbr></label>
                                    <div wire:ignore>
                                        <textarea class="form-control summernote-editor"
                                                  wire:model.defer="summary_description" id="summernote">

                                        </textarea>
                                    </div>
                                    @error('summary_description')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="header p-0">
                                    <h2><strong>اطلاعات کارشناس پرونده</strong></h2>
                                </div>
                                <hr>
                                <div class="row clearfix">
                                    <div class="form-group col-md-4">
                                        <label> کارشناس پرونده <abbr class="required text-danger"
                                                                     title="ضروری">*</abbr>
                                        </label>
                                        <div class="form-group">
                                            <input type="text" wire:model.defer="dossier_case" id="dossier_case"
                                                   class="form-control @error('dossier_case') is-invalid @enderror"
                                                   required/>
                                            <span id="dossier_case-display" class="text-warning"></span>
                                            @error('dossier_case')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label> شماره همراه کارشناس پرونده <abbr class="required text-danger"
                                                                                 title="ضروری">*</abbr>
                                        </label>
                                        <div class="form-group">
                                            <input type="text" wire:model.defer="expert_phone" id="expert_phone"
                                                   class="form-control @error('expert_phone') is-invalid @enderror"
                                                   required/>
                                            <span id="expert-number-display" class="text-warning"></span>
                                            @error('expert_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>شماره داخلی کارشناس پرونده<abbr class="required text-danger"
                                                                               title="ضروری">*</abbr>
                                        </label>
                                        <div class="form-group">
                                            <input type="text" wire:model.defer="expert_cellphone"
                                                   id="expert_cellphone"
                                                   class="form-control @error('expert_cellphone') is-invalid @enderror"
                                                   required/>
                                            <span id="expert_cellphone-display" class="text-warning"></span>
                                            @error('expert_cellphone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                            </div>
                            <div class="row clearfix">
                                <div class="form-group col-md-12 @error('summary_description') is-invalid @enderror">
                                    <div class="header p-0">
                                        <h2><strong>اطلاعات قضایی</strong></h2>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label> شماره حکم قضایی <abbr class="required text-danger"
                                                                          title="ضروری">*</abbr>
                                            </label>
                                            <div class="form-group">
                                                <input type="text" wire:model.defer="Judicial_number"
                                                       id="delivery-name"
                                                       class="form-control @error('Judicial_number') is-invalid @enderror"
                                                       required/>
                                                <span id="delivery-name-display" class="text-warning"></span>
                                                @error('Judicial_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>تاریخ حکم قضایی</label>
                                            <div class="input-group" wire:ignore>
                                                <div class="input-group-prepend"
                                                     onclick="$('#JudicialDate').focus();">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="zmdi zmdi-calendar-alt"></i></span>
                                                </div>
                                                <input type="hidden" id="JudicialDate-alt"
                                                       name="Judicial_date">
                                                <input type="text" class="form-control" id="JudicialDate"
                                                       value="{{ $Judicial_date ?? null }}" autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon1"
                                                          style="cursor: pointer;" onclick="destroyDatePicker()"><i
                                                            class="zmdi zmdi-close"></i></span>
                                                </div>
                                            </div>
                                            @error('Judicial_date')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="header">
                                            <label for="Judicial_image">تصویر حکم قضایی <small>(عکس با فرمت jpg و
                                                    png)</small></label>
                                        </div>
                                        <div class="body @error('Judicial_image') is-invalid @enderror">
                                            <div class="form-group" wire:ignore>
                                                <input wire:model="Judicial_image" id="Judicial_image" type="file"
                                                       class="dropify form-control" data-default-file="{{ asset('storage/Judicial-image/' . $banner->image) }}"
                                                       data-allowed-file-extensions="jpg png" data-max-file-size="2M">
                                            </div>
                                            @error('Judicial_image')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button wire:click="edit" wire:loading.attr="disabled"
                                        class="btn btn-raised btn-success waves-effect"><i wire:loading
                                                                                           class='zmdi zmdi-hc-fw zmdi-hc-spin'></i>
                                    ذخیره
                                </button>
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
    <script>
        $(document).ready(function () {
            $('#is_active').on('change', function (e) {
                let data = $('#is_active').select2("val");
            @this.set('is_active', data);
            });
            $('#userSelect').on('change', function (e) {
                let data = $('#userSelect').select2("val");
                if (data === '') {
                @this.set('user_category_id', null);
                } else {
                @this.set('user_category_id', data);
                }
            });
            $('#summernote').on('summernote.change', function (we, contents, $editable) {
            @this.set('summary_description', contents);
            });
            // Judicial Date picker
            JudicialDate = $(`#JudicialDate`).pDatepicker({
                initialValue: "{{$Judicial_date?true:false}}",
                initialValueType: 'persian',
                format: 'L',
                altField: `#JudicialDate-alt`,
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
                @this.set(`Judicial_date`, $(`#JudicialDate-alt`).val(), true);
                },
            });
        });
    </script>
@endpush
