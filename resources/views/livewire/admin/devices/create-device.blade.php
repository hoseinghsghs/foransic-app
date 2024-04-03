@section('title', 'ایجاد دیوایس')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>دریافت دیوایس</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href={{ route('admin.devices.index') }}>لیست دیوایس ها </a></li>
                        <li class="breadcrumb-item active">دریافت دیوایس</li>
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
                                <h2><strong>اطلاعات اصلی دیوایس</strong></h2>
                            </div>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label>نام دیوایس *</label>
                                    <div class="form-group">
                                        <input type="text" wire:model.defer="name"
                                            class="form-control @error('name') is-invalid @enderror" required />
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label> کد دیوایس</label>

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
                                            <option selected>دریافت دیوایس</option>
                                            <option disabled>در حال بررسی</option>
                                            <option disabled>تکمیل بررسی</option>
                                            <option disabled>تحویل دیوایس</option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="form-group col-md-4 col-sm-4 @error('use_id') is-invalid @enderror">
                                    <label for="userSelect">رده</label>
                                    <div wire:ignore>
                                        <select id="userSelect" name="user_category_id"data-placeholder="انتخاب رده"
                                            class="form-control ms search-select">
                                            <option></option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->cellphone }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('brand_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label> نام تحویل دهنده</label>
                                    <div class="form-group">
                                        <input type="text" wire:model.defer="delivery_name" id="delivery-name"
                                            class="form-control @error('delivery_name') is-invalid @enderror"
                                            required />
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
                                            required />
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
                                <div class="form-group col-md-12 @error('accessories') is-invalid @enderror">
                                    <label> لوازم جانبی *</label>
                                    <div>
                                        <textarea class="form-control" rows="6" wire:model.defer="accessories"></textarea>
                                    </div>
                                    @error('accessories')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="form-group col-md-12 @error('description') is-invalid @enderror">
                                    <label for="summernote">توضیحات</label>
                                    <div wire:ignore>
                                        <textarea class="form-control summernote-editor" id="summernote"></textarea>
                                    </div>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="header p-0 mt-3">
                                <h2><strong>تصاویر</strong></h2>
                            </div>
                            <hr>
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="header">
                                        <label for="primary_image">تصویر مکاتبه * <small>(عکس با فرمت jpg و
                                                png)</small></label>
                                    </div>
                                    <div class="body @error('primary_image') is-invalid @enderror">
                                        <div class="form-group" wire:ignore>
                                            <input wire:model="primary_image" id="primary_image" type="file"
                                                class="dropify form-control" required
                                                data-allowed-file-extensions="jpg png" data-max-file-size="2M">
                                        </div>
                                        @error('primary_image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12" wire:ignore>
                                <div class="header mt-0">
                                    <label class="mb-1"> تصاویر دیوایس</label>
                                </div>
                                <div class="form-group">
                                    <form action="{{ route('admin.uploade') }}" id="myDropzone" class="dropzone"
                                        method="POST" id="my-awesome-dropzone">
                                        @csrf
                                    </form>
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
    <!-- dropzone script start -->
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
            $('#statusSelect').on('change', function(e) {
                let data = $('#statusSelect').select2("val");
                @this.set('status', data);
            });
            $('#userSelect').on('change', function(e) {
                let data = $('#userSelect').select2("val");
                if (data === '') {
                    @this.set('user_category_id', null);
                } else {
                    @this.set('user_category_id', data);
                }
            });
            $('#summernote').on('summernote.change', function(we, contents, $editable) {
                @this.set('description', contents);
            });
        });
    </script>
@endpush
