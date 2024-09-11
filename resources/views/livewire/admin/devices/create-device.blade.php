@section('title', 'ایجاد شواهد دیجیتال')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>دریافت شواهد دیجیتال</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href={{ route('admin.devices.index') }}>لیست شواهد دیجیتال
                                ها </a>
                        </li>
                        <li class="breadcrumb-item active">دریافت شواهد دیجیتال</li>
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
                                <h2><strong>اطلاعات اصلی شواهد دیجیتال</strong></h2>
                            </div>
                            <hr>
                            <form wire:submit.prevent id="submit-device">
                                <div class="row clearfix">
                                    <div
                                        class="form-group col-sm-6 col-sm-6 @error('category_id') is-invalid @enderror">
                                        <label for="title-device">نام شواهد دیجیتال <abbr class="required" title="ضروری"
                                                style="color:red;">*</abbr></label>
                                        <div wire:ignore>
                                            <select id="title-device" name="title_managements_id"
                                                data-placeholder="انتخاب" class="form-control ms search-select">
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
                                    @if(is_null(auth()->user()->laboratory_id))
                                    @php($laboratories=\App\Models\Laboratory::all())
                                    <div
                                        class="form-group col-md-3 col-sm-3 @error('laboratory_id') is-invalid @enderror">
                                        <label for="userSelect">آزمایشگاه <abbr class="required text-danger"
                                                title="ضروری">*</abbr></label>
                                        <div wire:ignore>
                                            <select id="laboratorySelect" name="laboratory_id"
                                                data-placeholder="انتخاب آزمایشگاه"
                                                class="form-control ms search-select">
                                                <option></option>
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
                                    </div>
                                    @endif
                                    <div class="form-group col-md-3">
                                        <label>زمان پذیرش </label>
                                        <div class="input-group" wire:ignore>
                                            <div class="input-group-prepend" onclick="$('#createDate').focus();">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="zmdi zmdi-calendar-alt"></i></span>
                                            </div>
                                            <input type="hidden" id="createDate-alt" name="create_date">
                                            <input type="text" class="form-control" id="createDate" autocomplete="off"
                                                dir="ltr">
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
                                                class="form-control @error('code') is-invalid @enderror" required />
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
                                                <option value="0" selected>پذیرش شواهد دیجیتال</option>
                                                <option value="1" disabled>در حال بررسی</option>
                                                <option value="2" disabled> تکمیل تجزیه و تحلیل
                                                </option>
                                                <option value="3" disabled>خروج شواهد دیجیتال</option>
                                            </select>
                                        </div>
                                        @error('status')
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
                                    {{-- category attributes --}}
                                    @if ($category_id && $this->category->attributes()->exists())
                                    @foreach ($this->category->attributes as $attribute)
                                    <div class="form-group col-md-3" wire:key="{{ $attribute->id }}">
                                        <label>{{ $attribute->name }}</label>
                                        <div class="form-group">
                                            @if ($attribute->def_values)
                                            <div wire:ignore>
                                                <select id="valueSelect" wire:model="attribute_values.{{ $attribute->id }}"
                                                    data-placeholder="انتخاب "
                                                    class="form-control ms search-select @error(" attribute_values.{{$attribute->id}}") is-invalid @enderror">
                                                    <option value=null>انتخاب کنید</option>
                                                    @foreach (json_decode($attribute->def_values, true) as $def_valuee)
                                                    <option value="{{$def_valuee}}">
                                                        {{ $def_valuee }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @else
                                            <input type="text"
                                                wire:model="attribute_values.{{ $attribute->id }}"
                                                id="delivery_code"
                                                class="form-control @error(" attribute_values.{{ $attribute->id }}") is-invalid @enderror" />
                                            @endif
                                            @error("attribute_values.{{ $attribute->id }}")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    <div class="form-group col-md-4 col-sm-4 @error('dossier_id') is-invalid @enderror">
                                        <label for="dossierSelect">الحاق به پرونده <abbr class="required" title="ضروری"
                                                style="color:red;">*</abbr></label>
                                        <div wire:ignore>
                                            <select id="dossierSelect" name="dossier_id"
                                                data-placeholder="انتخاب پرونده"
                                                class="form-control ms search-select">
                                                <option></option>
                                                @foreach ($dossiers as $dossier)
                                                <option
                                                    value="{{ $dossier->id }}" @selected(session()->get('dossier') == $dossier->id)>
                                                    {{ $dossier->name }} - {{ $dossier->number_dossier }}
                                                    - {{$dossier->company->name}}
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
                                        <div class="form-group col-md-3 col-sm-3 @error('parent_id') is-invalid @enderror">
                                            <label for="rel"> ارتباط با سایر شواهد<abbr class="required" title="ضروری"
                                                    style="color:red;">*</abbr></label>
                                            <div>
                                                <select id="rel" name="parent_id" wire:model.defer="parent_id"
                                                    data-placeholder="انتخاب پرونده"
                                                    class="form-control ms search-select">
                                                    <option value="0">شاهد اصلی </option>
                                                    @foreach ($parent_devices as $parent_device)
                                                    {{ $parent_device->id  }}
                                                    <option
                                                        value="{{ $parent_device->id }}">
                                                        آی دی: {{ $parent_device->id  }} - عنوان: {{ $parent_device->category->title}} - مدل: {{ $parent_device->code  }}
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
                                    <div class="form-group col-md-4">
                                        <label> نام تحویل دهنده <abbr class="required" title="ضروری" style="color:red;">*</abbr></label>
                                        <div class="form-group">
                                            <input type="text" wire:model.defer="delivery_name" id="delivery-name"
                                                class="form-control @error('delivery_name') is-invalid @enderror"
                                                required />
                                            @error('delivery_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label> کد پرسنلی تحویل دهنده</label>
                                        <div class="form-group">
                                            <input type="text" wire:model.defer="delivery_code" id="delivery_code"
                                                class="form-control @error('delivery_code') is-invalid @enderror" />
                                            @error('delivery_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="form-group col-md-12 @error('trait') is-invalid @enderror">
                                        <label> توضیحات شواهد </label>
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
                                        <textarea class="form-control" rows="6"
                                            wire:model.defer="accessories"></textarea>
                                        @error('accessories')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="form-group col-md-12 @error('description') is-invalid @enderror">
                                        <label for="summernote">تجربه نگاری کارشناس فارنزیک در اقدامات :</label>
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
                                    <div class="form-group col-md-3">
                                        <label> شماره خودکار ساز نامه درخواست</label>
                                        <div class="form-group">
                                            <input type="text" wire:model.defer="correspondence_number"
                                                id="correspondence_number"
                                                class="form-control @error('correspondence_number') is-invalid @enderror" />
                                            @error('correspondence_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>تاریخ مکاتبه درخواست </label>
                                        <div class="input-group" wire:ignore>
                                            <div class="input-group-prepend"
                                                onclick="$('#correspondenceDate').focus();">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="zmdi zmdi-calendar-alt"></i></span>
                                            </div>
                                            <input type="hidden" id="correspondenceDate-alt" name="correspondence_date">
                                            <input type="text" class="form-control" id="correspondenceDate" dir="ltr"
                                                autocomplete="off">
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
                                        <div class="form-group">
                                            <input type="text" wire:model.defer="reply_correspondence_number"
                                                id="reply_correspondence_number"
                                                class="form-control @error('correspondence_number') is-invalid @enderror" />
                                            @error('reply_correspondence_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                                                autocomplete="off" dir="ltr">
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

                                    <div class="form-group col-md-12">
                                        <div class="header">
                                            <label for="primary_image">تصویر مکاتبه <small>(عکس با فرمت jpg و
                                                    png)</small></label>
                                        </div>
                                        <div class="body @error('primary_image') is-invalid @enderror">
                                            <div class="form-group" wire:ignore>
                                                <input wire:model="primary_image" id="primary_image" type="file"
                                                    class="dropify form-control"
                                                    data-allowed-file-extensions="jpg png" data-max-file-size="10M">
                                            </div>
                                            @error('primary_image')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="header p-0 mt-3">
                                    <h2><strong>تصاویر شواهد دیجیتال</strong></h2>
                                </div>
                                <hr>
                            </form>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12" wire:ignore>
                                    <div class="header mt-0">
                                        <label class="mb-1"> تصاویر شواهد دیجیتال</label>
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
                                <button wire:click="create('1')" wire:loading.attr="disabled" type="submit"
                                    form="submit-device" class="btn btn-raised btn-success waves-effect"><i
                                        wire:loading class='zmdi zmdi-hc-fw zmdi-hc-spin'></i>
                                    ذخیره
                                </button>
                                <button wire:click="create('2')" wire:loading.attr="disabled" type="submit"
                                    form="submit-device" class="btn btn-raised btn-success waves-effect"><i
                                        wire:loading class='zmdi zmdi-hc-fw zmdi-hc-spin'></i>
                                    ذخیره و جدید
                                </button>
                                <button wire:click="create('3')" wire:loading.attr="disabled" type="submit"
                                    form="submit-device" class="btn btn-raised btn-success waves-effect"><i
                                        wire:loading class='zmdi zmdi-hc-fw zmdi-hc-spin'></i>
                                    ذخیره و مشاهده پرونده
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
<link rel="stylesheet" type="text/css" href="{{asset('vendor/date-time-picker/persian-datepicker.min.css')}}" />
<!-- تاریخ پایان-->
<link rel=" stylesheet" href={{ asset('assets\admin\css\dropzone.min.css') }} type="text/css" />
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
<script src="{{asset('vendor/date-time-picker//persian-datepicker.min.js')}}"></script>
<script>
    $('.scroll').click(function() {
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
        success: function(file, response) {
            $(file.previewTemplate).append(
                '<span class="server_file">' + response + "</span>"
            );
        },
        removedfile: function(file) {
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
                sucess: function(data) {
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
        init: function() {
            dzClosure =
                this; // Makes sure that 'this' is understood inside the functions below.
            // for Dropzone to process the queue (instead of default form behavior):
            var el = document.getElementById("submit-all");
            if (el) {
                el.addEventListener("click", function(e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    dzClosure.processQueue();
                });
            }
            //send all the form data along with the files:
            this.on("sendingmultiple", function(data, xhr, formData) {
                formData.append("firstname", jQuery("#firstname").val());
                formData.append("lastname", jQuery("#lastname").val());
            });
            this.on("successmultiple", function(files, response) {
                // Gets triggered when the files have successfully been sent.
                // Redirect user or notify of success.
            });
            this.on("errormultiple", function(files, response) {
                // Gets triggered when there was an error sending the files.
                // Maybe show form again, and notify user of error
                alert("error");
            });
        },
    };

    $(document).ready(function() {
        $('#laboratorySelect').on('change', function(e) {
            let data = $('#laboratorySelect').select2("val");
            if (data === '') {
                @this.set('laboratory_id', null);
            } else {
                @this.set('laboratory_id', data);
            }
        });

        $('#statusSelect').on('change', function(e) {
            let data = $('#statusSelect').select2("val");
            @this.set('status', data);
        });

        $('#title-device').on('change', function(e) {
            let data = $('#title-device').select2("val");
            @this.set('category_id', data);
        });

        $('#dossierSelect').on('change', function(e) {
            let data = $('#dossierSelect').select2("val");
            if (data === '') {
                @this.set('dossier_id', null);
            } else {
                @this.set('dossier_id', data);
            }
        });
        $('#rel').on('change', function(e) {
            let data = $('#rel').select2("val");
            alert(data);
            if (data === '') {
                @this.set('parent_id', 0);
            } else {
                @this.set('parent_id', data);
            }
        });
        $('#summernote').on('summernote.change', function(we, contents, $editable) {
            @this.set('description', contents);
        });
    });
</script>
{{-- دیتا پیکر --}}
<script>
    let correspondenceDate;
    let reply_correspondenceDate;
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

    function destroyDatePicker3() {
        $(`#reply_correspondenceDate`).val(null);
        $(`#reply_correspondenceDate-alt`).val(null);
        reply_correspondenceDate.touched = false;
        reply_correspondenceDate.options = {
            initialValue: false
        }
        @this.set(`reply_correspondence_date`, null, true);
    }

    $(document).ready(function() {
        correspondenceDate = $(`#correspondenceDate`).pDatepicker({
            initialValue: false,
            initialValueType: 'persian',
            format: 'L',
            altField: `#correspondenceDate-alt`,
            altFormat: 'g',
            altFieldFormatter: function(unixDate) {
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
            onSelect: function(unix) {
                @this.set(`correspondence_date`, $(`#correspondenceDate-alt`).val(), true);
            },
        });

        reply_correspondenceDate = $(`#reply_correspondenceDate`).pDatepicker({
            initialValue: false,
            initialValueType: 'persian',
            format: 'L',
            altField: `#reply_correspondenceDate-alt`,
            altFormat: 'g',
            altFieldFormatter: function(unixDate) {
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
            onSelect: function(unix) {
                @this.set(`reply_correspondence_date`, $(`#reply_correspondenceDate-alt`).val(), true);
            },
        });

        createDate = $(`#createDate`).pDatepicker({
            initialValue: true,
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
                @this.set(`receive_date`, $(`#createDate-alt`).val(), true);
            },
        });
        // set default to receive date
        @this.set(`receive_date`, $(`#createDate-alt`).val(), true);
    });
</script>
@endpush
