@section('title', 'ایجاد دستگاه / قطعه')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>دریافت دستگاه / قطعه</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href={{ route('admin.devices.index') }}>لیست دستگاه / قطعه
                                ها </a>
                        </li>
                        <li class="breadcrumb-item active">دریافت دستگاه / قطعه</li>
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
                                <h2><strong>اطلاعات اصلی دستگاه / قطعه</strong></h2>
                            </div>
                            <hr>

                            <div class="row clearfix">
                                <div class="form-group col-sm-6 col-sm-6 @error('category_id') is-invalid @enderror">
                                    <label for="title-device">نام دستگاه یا قطعه <abbr class="required"
                                                                                      title="ضروری" style="color:red;">*</abbr></label>
                                    <div wire:ignore>
                                        <select id="title-device" name="title_managements_id"
                                                data-placeholder="انتخاب"
                                                class="form-control ms search-select">
                                            <option></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
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
                                    <label> سریال یا شماره اموال دستگاه / قطعه <abbr class="required"
                                                                                     title="ضروری" style="color:red;">*</abbr></label>
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
                                                class="form-control ms select2">
                                            <option value="0" selected>پذیرش دستگاه / قطعه</option>
                                            <option value="1" disabled>در حال بررسی</option>
                                            <option value="2" disabled> تکمیل تجزیه و تحلیل
                                            </option>
                                            <option value="3" disabled>تحویل دستگاه / قطعه</option>
                                        </select>
                                    </div>
                                    @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 col-sm-4 @error('dossier_id') is-invalid @enderror">
                                    <label for="dossierSelect">الحاق به پرونده <abbr class="required"
                                                                                     title="ضروری" style="color:red;">*</abbr></label>
                                    <div wire:ignore>
                                        <select id="dossierSelect" name="dossier_id" data-placeholder="انتخاب پرونده"
                                                class="form-control ms search-select">
                                            <option></option>
                                            @foreach ($dossiers as $dossier)
                                                <option value="{{ $dossier->id }}">
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
                                    <label> نام تحویل دهنده <abbr class="required"
                                                                  title="ضروری" style="color:red;">*</abbr></label>
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
                                               class="form-control @error('delivery_code') is-invalid @enderror"
                                               required/>
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
                                    <label> مشخصات (ظرفیت ، مدل و...)</label>
                                    <div>
                                        <textarea class="form-control" rows="6" wire:model.defer="trait"></textarea>
                                    </div>
                                    @error('trait')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="form-group col-md-12 @error('accessories') is-invalid @enderror">
                                    <label> لوازم جانبی </label>
                                    <div>
                                        <textarea class="form-control" rows="6"
                                                  wire:model.defer="accessories"></textarea>
                                    </div>
                                    @error('accessories')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="form-group col-md-12 @error('description') is-invalid @enderror">
                                    <label for="summernote">توضیحات و اظهارات درخواست کننده :</label>
                                    <div wire:ignore>
                                        <textarea class="form-control summernote-editor" id="summernote"></textarea>
                                    </div>
                                    @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
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
                                               class="form-control @error('correspondence_number') is-invalid @enderror"
                                               required/>
                                        <span id="correspondence_number-display" class="text-warning"></span>
                                        @error('correspondence_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>تاریخ مکاتبه </label>
                                    <div class="input-group" wire:ignore>
                                        <div class="input-group-prepend" onclick="$('#correspondenceDate').focus();">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="zmdi zmdi-calendar-alt"></i></span>
                                        </div>
                                        <input type="hidden" id="correspondenceDate-alt" name="correspondence_date">
                                        <input type="text" class="form-control" id="correspondenceDate"
                                               value="{{ $correspondence_date ?? null }}" autocomplete="off">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1" style="cursor: pointer;"
                                                  onclick="destroyDatePicker()"><i class="zmdi zmdi-close"></i></span>
                                        </div>
                                    </div>
                                    @error('correspondence_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="header">
                                        <label for="primary_image">تصویر مکاتبه <small>(عکس با فرمت jpg و
                                                png)</small></label>
                                    </div>
                                    <div class="body @error('primary_image') is-invalid @enderror">
                                        <div class="form-group" wire:ignore>
                                            <input wire:model="primary_image" id="primary_image" type="file"
                                                   class="dropify form-control" data-allowed-file-extensions="jpg png"
                                                   data-max-file-size="2M">
                                        </div>
                                        @error('primary_image')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="header p-0 mt-3">
                                <h2><strong>تصاویر دستگاه یا قطعه</strong></h2>
                            </div>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12" wire:ignore>
                                    <div class="header mt-0">
                                        <label class="mb-1"> تصاویر دستگاه / قطعه</label>
                                    </div>
                                    <div class="form-group">
                                        <form action="{{ route('admin.uploade') }}" id="myDropzone" class="dropzone"
                                              method="POST" id="my-awesome-dropzone">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button wire:click="create" wire:loading.attr="disabled"
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
    <!-- تاریخ -->
    <link rel="stylesheet" type="text/css"
          href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css"/>
    <!-- تاریخ پایان-->
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
    <script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
    <script>
        $('.scroll').click(function () {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    </script>
    <script>
        Dropzone.options.myDropzone = {
            parallelUploads: 5,
            maxFiles: 5,
            maxFilesize: 1,
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            previewsContainer: ".dropzone",
            clickable: ".dropzone",
            success: function (file, response) {
                $(file.previewTemplate).append(
                    '<span class="server_file">' + response + "</span>"
                );
            },
            removedfile: function (file) {
                var server_file = $(file.previewTemplate)
                    .children(".server_file")
                    .text();
                alert(server_file);
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.del') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: server_file,
                        request: 2,
                    },
                    sucess: function (data) {
                        console.log("success: " + data);
                    },
                });

                var _ref;
                return (_ref = file.previewElement) != null ?
                    _ref.parentNode.removeChild(file.previewElement) :
                    void 0;
            },
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}",
            },
            dictDefaultMessage: "<span style='color:gray'>تصاویر را بکشید و در اینجا رها کنید</span>",
            dictFallbackMessage: "Your browser does not support drag'n'drop file uploads.",
            dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
            dictFileTooBig: "File is too big (@{{ filesize }}MiB). Max filesize: @{{ maxFilesize }}MiB.",
            dictInvalidFileType: "You can't upload files of this type.",
            dictResponseError: "Server responded with @{{ statusCode }} code.",
            dictCancelUpload: "توقف آپلود",
            dictUploadCanceled: "Upload canceled.",
            dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
            dictRemoveFile: "حذف",
            dictRemoveFileConfirmation: null,
            dictMaxFilesExceeded: "You can not upload any more files.",
            init: function () {
                dzClosure =
                    this; // Makes sure that 'this' is understood inside the functions below.
                // for Dropzone to process the queue (instead of default form behavior):
                var el = document.getElementById("submit-all");
                if (el) {
                    el.addEventListener("click", function (e) {
                        // Make sure that the form isn't actually being sent.
                        e.preventDefault();
                        e.stopPropagation();
                        dzClosure.processQueue();
                    });
                }
                //send all the form data along with the files:
                this.on("sendingmultiple", function (data, xhr, formData) {
                    formData.append("firstname", jQuery("#firstname").val());
                    formData.append("lastname", jQuery("#lastname").val());
                });
                this.on("successmultiple", function (files, response) {
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                });
                this.on("errormultiple", function (files, response) {
                    // Gets triggered when there was an error sending the files.
                    // Maybe show form again, and notify user of error
                    alert("error");
                });
            },
        };

        $(document).ready(function () {
            $('#statusSelect').on('change', function (e) {
                let data = $('#statusSelect').select2("val");
            @this.set('status', data);
            });

            $('#title-device').on('change', function (e) {
                let data = $('#title-device').select2("val");
            @this.set('category_id', data);
            });

            $('#dossierSelect').on('change', function (e) {
                let data = $('#dossierSelect').select2("val");
                if (data === '') {
                @this.set('dossier_id', null);
                } else {
                @this.set('dossier_id', data);
                }
            });
            $('#summernote').on('summernote.change', function (we, contents, $editable) {
            @this.set('description', contents);
            });
        });
    </script>
    {{-- دیتا پیکر --}}
    <script>
        let correspondenceDate;

        function destroyDatePicker() {
            $(`#correspondenceDate`).val(null);
            $(`#correspondenceDate-alt`).val(null);
            correspondenceDate.touched = false;
            correspondenceDate.options = {
                initialValue: false
            }
        @this.set(`correspondence_date`, null, true);
        }

        $(document).ready(function () {
            correspondenceDate = $(`#correspondenceDate`).pDatepicker({
                initialValue: false,
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
                @this.set(`correspondence_date`, $(`#correspondenceDate-alt`).val(), true);
                },
            });
        });
    </script>
@endpush
