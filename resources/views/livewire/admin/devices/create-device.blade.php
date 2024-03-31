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
                                <div class="col-sm-8">
                                    <label>نام دیوایس *</label>
                                    <div class="form-group">
                                        <input type="text" wire:model.defer="device_name"
                                               class="form-control @error('device_name') is-invalid @enderror"
                                               required/>
                                        @error('device_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-4 col-sm-6 @error('position') is-invalid @enderror">
                                    <label for="positionSelect">وضعیت بررسی</label>
                                    <div wire:ignore>
                                        <select id="positionSelect" data-placeholder="انتخاب وضعیت"
                                                class="form-control ms select2">
                                            <option>دریافت دیوایس</option>
                                            <option>در حال بررسی</option>
                                            <option>تکمیل بررسی</option>
                                            <option>تحویل دیوایس</option>
                                        </select>
                                    </div>
                                    @error('position')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- <div class="form-group col-md-3 col-auto">
                                    <label for="is_active">وضعیت</label>
                                    <div class="switchToggle">
                                        <input type="checkbox" wire:model="status" id="switch">
                                        <label for="switch">Toggle</label>
                                    </div>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                                <div class="form-group col-md-6 col-sm-6 @error('brand_id') is-invalid @enderror">
                                    <label for="brandSelect">رده</label>
                                    <div wire:ignore>
                                        <select id="brandSelect" name="brand_id" data-placeholder="انتخاب رده"
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
                                <div class="form-group col-md-6">
                                    <label> نام تحویل دهنده</label>

                                    <div class="form-group">
                                        <input type="text" wire:model.defer="seo_title" id="seo-title"
                                               onkeyup="Count()"
                                               class="form-control @error('seo_title') is-invalid @enderror" required/>
                                        <span id="seo-title-display" class="text-warning"></span>
                                        @error('seo_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="form-group col-sm-9 @error('tag_ids.*') is-invalid @enderror">
                                    <label for="tagSelect">تگ ها</label>
                                    <div wire:ignore>
                                        <select id="tagSelect" data-placeholder="انتخاب تگ"
                                            class="form-control ms select2 " multiple data-close-on-select="false">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('tag_ids.*')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div> --}}
                            </div>


                            <div class="row clearfix">
                                <div class="form-group col-md-12 @error('seo_description') is-invalid @enderror">
                                    <label> لوازم جانبی *</label>
                                    <div>
                                        <textarea class="form-control" rows="3" wire:model.defer="seo_description"
                                                  onkeyup="CountD()"
                                                  id="seo-description"></textarea>
                                    </div>
                                    <span id="seo-description-display" class="text-warning"></span>
                                    @error('seo_description')
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

                            {{-- <div class="row clearfix @error('KeyWords_ids.*') is-invalid @enderror">
                                <div class="form-group col-md-12">
                                    <label for="KeyWordsSelect">کلمات کلیدی</label>
                                    <div wire:ignore>
                                        <select id="KeyWordsSelect" data-placeholder="انتخاب"
                                            class="form-control ms select2 " multiple data-close-on-select="false">
                                            @foreach ($keywords as $keyword)
                                                <option value="{{ $keyword->id }}">{{ $keyword->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('KeyWords_ids.*')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div> --}}

                            <div class="header p-0">
                                <h2><strong>مدیریت اقدامات
                                    </strong></h2>
                            </div>
                            <hr>
                            <div class="row clearfix">
                                <div class="form-group col-sm-4 @error('user_id') is-invalid @enderror">
                                    <label for="userSelect"><i wire:loading class='zmdi zmdi-hc-fw zmdi-hc-spin'></i>
                                        مجموعه اقدامات *</label>
                                    <div wire:ignore>
                                        <select id="userSelect" data-placeholder="انتخاب پرسنل" required
                                                class="form-control ms select2-styled" data-live-search="true">
                                            <option></option>
                                            <option class="pr-2" value="10">
                                                &#8617;کل اقدامات
                                            </option>
                                            @foreach ($users as $user)
                                                @if ($user->count() > 0)
                                                    <option class="pr-2" value="{{ $user->id }}">
                                                        &#8617;
                                                        {{ $user->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('user_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- <div class="form-group col-md-3 col-auto">
                                    <label for="is_active">حالت تماس با ما</label>
                                    <div class="switchToggle">
                                        <input type="checkbox" wire:model="contact" id="switch-1">
                                        <label for="switch-1">Toggle</label>
                                    </div>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                            </div>
                            {{-- @if ($category_id && $category_attributes && $category_variation) --}}
                            <!-- ویژگی های ثابت -->
                            <div id="attributesContainer">
                                {{-- <div class="row clear-fix" id="attributes">
                                        @foreach ($category_attributes as $attribute)
                                            <div class="form-group col-sm-3">
                                                <label
                                                    for="attribute-{{ $attribute->id }}">{{ $attribute->name }}</label>
                                                <input id="attribute-{{ $attribute->id }}"
                                                    wire:model.defer="attribute_values.{{ $attribute->id }}"
                                                    @class([
                                                        'form-control',
                                                        'is-invalid' => $errors->has("attribute_values.$attribute->id"),
                                                    ])>
                                                @error("attribute_values.$attribute->id")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>
                                    <p>ویژگی متغییر برای <span id="variationName"
                                            class="font-weight-bold">{{ $category_variation->name }}</span> --}}
                                <button wire:loading.attr="disabled" wire:target="addVariation"
                                        class="btn btn-sm btn-info" type="button" wire:click="addVariation">
                                    افزودن
                                </button>
                                </p>
                                <!-- ویژگی های متغییر -->
                                @foreach ($variations as $key => $var)
                                    <div class="p-2 mb-2 rounded bg-light">
                                        @if (!$loop->first)
                                            <button wire:loading.attr="disabled" wire:target="removeVariation"
                                                    type="button" class="close text-danger" style="opacity: 1;"
                                                    wire:click="removeVariation({{ $key }})">&times;
                                            </button>
                                        @endif
                                        <div class="row clearfix ">

                                            <div class="form-group col-md-3 col-sm-4">
                                                <label>نام *</label>
                                                <input id="code" wire:model="code" @class([
                                                    'form-control',
                                                    'is-invalid' => $errors->has("variations.$key.name"),
                                                ])
                                                wire:model.defer="variations.{{ $key }}.name">
                                                @error("variations.$key.name")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            {{--

                                            <div class="form-group col-md-3 col-sm-4">
                                                <label>قیمت پایه *</label>
                                                <input dir="ltr" type="number" @class([
                                                    'form-control without-spin',
                                                    'is-invalid' => $errors->has("variations.$key.base_price"),
                                                ])
                                                    wire:model="variations.{{ $key }}.base_price"
                                                    wire:keydown.debounce.150ms="updateFinalPrice({{ $key }})">
                                                @if (key_exists('base_price', $var) && $var['base_price'])
                                                    <span class="pt-1">{{ number_format($var['base_price']) }}
                                                        تومان
                                                    </span>
                                                @endif
                                                @error("variations.$key.base_price")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-3 col-sm-4">
                                                <label>درصد افزایش *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i
                                                                class="fa fa-percent"></i></span>
                                                    </div>
                                                    <input dir="ltr" type="number" @class([
                                                        'form-control without-spin',
                                                        'is-invalid' => $errors->has("variations.$key.percent_price"),
                                                    ])
                                                        wire:model="variations.{{ $key }}.percent_price"
                                                        wire:keydown.debounce.150ms="updateFinalPrice({{ $key }})">
                                                </div>
                                                @error("variations.$key.percent_price")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-3 col-sm-4">
                                                <label>قیمت *</label>
                                                <input dir="ltr" type="number" @class([
                                                    'form-control without-spin',
                                                    'is-invalid' => $errors->has("variations.$key.price"),
                                                ])
                                                    wire:model="variations.{{ $key }}.price">
                                                @if (key_exists('price', $var) && $var['price'])
                                                    <span class="pt-1">{{ number_format($var['price']) }}
                                                        تومان
                                                    </span>
                                                @endif
                                                @error("variations.$key.price")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div> --}}

                                            <div
                                                class="form-group col-md-8 col-sm-8 @error('user_id') is-invalid @enderror">
                                                <label for="shop-select">اقدام کننده</label>
                                                <select id="shop-select" wire:key="{{ $key }}"
                                                        @class([
                                                            'form-control',
                                                            'is-invalid' => $errors->has("variations.$key.user_id"),
                                                        ])
                                                        wire:model="variations.{{ $key }}.user_id"
                                                        data-placeholder="انتخاب اقدام کننده">
                                                    <option value="0">انتخاب اقدام کننده</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">
                                                            {{ $user->id }} - {{ $user->name }} -

                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error("variations.$key.user_id")
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label>مدت کار روی دیوایس به ساعت *</label>
                                                <div class="form-group">
                                                    <input @class([
                                                        'form-control',
                                                        'is-invalid' => $errors->has("variations.$key.time_guarantee"),
                                                    ])
                                                           wire:model.defer="variations.{{ $key }}.time_guarantee">
                                                    @error("variations.$key.time_guarantee")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div
                                                class="form-group col-md-12 @error('seo_description') is-invalid @enderror">
                                                <label> توضیح *</label>
                                                <div>
                                                    <textarea class="form-control" rows="5"
                                                              wire:model.defer="seo_description" onkeyup="CountD()"
                                                              id="seo-description"></textarea>
                                                </div>
                                                <span id="seo-description-display" class="text-warning"></span>
                                                @error('seo_description')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            {{--
                                            <div class="form-group col-md-3 col-sm-4">
                                                <label>تعداد *</label>
                                                <input dir="ltr" @class([
                                                    'form-control without-spin',
                                                    'is-invalid' => $errors->has("variations.$key.quantity"),
                                                ])
                                                    wire:model.defer="variations.{{ $key }}.quantity"
                                                    type="number">
                                                @error("variations.$key.quantity")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-3 col-sm-4">
                                                <label>شناسه انبار</label>
                                                <input dir="ltr" @class([
                                                    'form-control',
                                                    'is-invalid' => $errors->has("variations.$key.sku"),
                                                ])
                                                    wire:model="variations.{{ $key }}.sku">
                                                @error("variations.$key.sku")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label>گارانتی</label>
                                                <div class="form-group">
                                                    <input @class([
                                                        'form-control',
                                                        'is-invalid' => $errors->has("variations.$key.guarantee"),
                                                    ])
                                                        wire:model.defer="variations.{{ $key }}.guarantee">
                                                    @error("variations.$key.guarantee")
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div> --}}

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- @endif --}}
                            <!-- ویژگی های متغییر پایان-->
                            <!-- هزینه ارسال -->
                            {{-- <div class="header p-0 mt-3">
                                <h2><strong>هزینه ارسال</strong></h2>
                            </div>
                            <hr> --}}
                            {{-- <div class="row clearfix">
                                <div class="col-sm-6 form-group">
                                    <label for="delivery_amount">هزینه ارسال*</label>
                                    <input dir="ltr" required
                                        class="form-control without-spin @error('delivery_amount') is-invalid @enderror"
                                        id="delivery_amount" wire:model="delivery_amount" type="number">
                                    @if ($delivery_amount)
                                        <span class="pt-1">{{ number_format($delivery_amount) }} تومان </span>
                                    @endif
                                    @error('delivery_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label for="delivery_amount_per_product"> هزینه ارسال به ازای دیوایس
                                        اضافی*</label>
                                    <div class="form-group">
                                        <input dir="ltr"
                                            class="form-control without-spin @error('delivery_amount') is-invalid @enderror"
                                            id="delivery_amount_per_product" wire:model="delivery_amount_per_product"
                                            type="number">
                                        @if ($delivery_amount_per_product)
                                            <span class="pt-1">{{ number_format($delivery_amount_per_product) }}
                                                تومان </span>
                                        @endif
                                        @error('delivery_amount_per_product')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}
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
    </div>
</section>
@push('styles')
    <link rel=" stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
    <style>
        .dropzone {
            border-radius: 5px;
            border-style: solid !important;
            border-width: 2px !important;
            border-color: #D2D5D6 !important;
            background-color: white !important;
        }
    </style>
    <!-- تاریخ -->
    <link rel="stylesheet" type="text/css"
          href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css"/>
    <!-- تاریخ پایان-->

@endpush

@push('scripts')
    <script>
        var Inputmask = require('inputmask');
        Inputmask({
            regex: "^\d{3}\.\d{3}\.\d{3}$",
            placeholder: "_",
            showMaskFocus: true,
            showMaskOnHover: false,
            clearIncomplete: true
        }).mask(document.getElementById("code"));
    </script>
    <script>
        $(document).ready(function () {
            $('#positionSelect').on('change', function (e) {
                let data = $('#positionSelect').select2("val");
            @this.set('position', data);
            });
            $('#brandSelect').on('change', function (e) {
                let data = $('#brandSelect').select2("val");
                if (data === '') {
                @this.set('brand_id', null);
                } else {
                @this.set('brand_id', data);
                }
            });
            $('#tagSelect').on('change', function (e) {
                let data = $('#tagSelect').select2("val");
            @this.set('tags_id', data);
            });
            $('#categorySelect').on('change', function (e) {
                let data = $('#categorySelect').select2("val");
            @this.set('category_id', data);
            });

            $("#KeyWordsSelect").on('change', function (e) {
                let data = $('#KeyWordsSelect').select2("val");
            @this.set('keywords_id', data);
            });

            $('#summernote').on('summernote.change', function (we, contents, $editable) {
            @this.set('description', contents);
            });
        });
    </script>
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
    </script>
    <!-- dropzone script end -->
    <script type="text/javascript">
        function Count() {

            var i = document.getElementById("seo-title").value.length;
            document.getElementById("seo-title-display").innerHTML = i;

        }

        function CountD() {

            var i = document.getElementById("seo-description").value.length;
            document.getElementById("seo-description-display").innerHTML = i;

        }

        //data piker start
    </script>

    <script>
        $(document).ready(function () {
            $('#positionSelect').on('change', function (e) {
                let data = $('#positionSelect').select2("val");
            @this.set('position', data);
            });
            $('#brandSelect').on('change', function (e) {
                let data = $('#brandSelect').select2("val");
                console.log(data);
                if (data === '') {
                @this.set('brand_id', null);
                } else {
                @this.set('brand_id', data);
                }
            });
            $('#tagSelect').on('change', function (e) {
                let data = $('#tagSelect').select2("val");
            @this.set('tags_id', data);
            });
            $('#KeyWordsSelect').on('change', function (e) {
                let data = $('#KeyWordsSelect').select2("val");
            @this.set('keywords_id', data);
            });
            $('#summernote').on('summernote.change', function (we, contents, $editable) {
            @this.set('description', contents);
            });
        });
        let variations = @json($variations);
        let dateTimePicker = {};
        Object.keys(variations).forEach(index => {
            dateTimePicker[index] = {
                from: null,
                to: null
            }
            dateTimePicker[index].from = $(`#variationInputDateOnSaleFrom-${index}`).pDatepicker({
                initialValue: variations[index]['date_on_sale_from'] ? true : false,
                initialValueType: 'gregorian',
                format: 'LLLL',
                altField: `#variationInputDateOnSaleFrom-alt-${index}`,
                altFormat: 'g',
                minDate: "new persianDate().unix()",
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
                        var p = new persianDate(unixDate).toCalendar('gregorian').format(
                            'YYYY-MM-DD HH:mm:ss');
                        return p;
                    }
                    if (thisAltFormat === 'unix' || thisAltFormat === 'u') {
                        return unixDate;
                    } else {
                        var pd = new persianDate(unixDate);
                        pd.formatPersian = this.persianDigit;
                        return pd.format(self.altFormat);
                    }
                },
                onSelect: function (unix) {
                    dateTimePicker[index].from.touched = true;
                    if (dateTimePicker[index].to && dateTimePicker[index].to.options && dateTimePicker[
                        index].to.options.minDate != unix) {
                        var cachedValue = dateTimePicker[index].to.getState().selected.unixDate;
                        dateTimePicker[index].to.options = {
                            minDate: unix
                        };
                        if (dateTimePicker[index].to.touched) {
                            dateTimePicker[index].to.setDate(cachedValue);
                        }
                    }
                @this.set(`variations.${index}.date_on_sale_from`, $(
                    `#variationInputDateOnSaleFrom-alt-${index}`).val(), true);
                },
            });

            dateTimePicker[index].to = $(`#variationInputDateOnSaleTo-${index}`).pDatepicker({
                initialValue: variations[index]['date_on_sale_from'] ? true : false,
                initialValueType: 'gregorian',
                format: 'LLLL',
                altField: `#variationInputDateOnSaleTo-alt-${index}`,
                altFormat: 'g',
                minDate: "new persianDate().unix()",
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
                        var p = new persianDate(unixDate).toCalendar('gregorian').format(
                            'YYYY-MM-DD HH:mm:ss');
                        return p;
                    }
                    if (thisAltFormat === 'unix' || thisAltFormat === 'u') {
                        return unixDate;
                    } else {
                        var pd = new persianDate(unixDate);
                        pd.formatPersian = this.persianDigit;
                        return pd.format(self.altFormat);
                    }
                },
                onSelect: function (unix) {
                    dateTimePicker[index].to.touched = true;
                    if (dateTimePicker[index].from && dateTimePicker[index].from.options &&
                        dateTimePicker[index].from.options.maxDate != unix) {
                        var cachedValue = dateTimePicker[index].from.getState().selected.unixDate;
                        dateTimePicker[index].from.options = {
                            maxDate: unix
                        };
                        if (dateTimePicker[index].from.touched) {
                            dateTimePicker[index].from.setDate(cachedValue);
                        }
                    }
                @this.set(`variations.${index}.date_on_sale_to`, $(
                    `#variationInputDateOnSaleTo-alt-${index}`).val(), true);
                }
            });
        });

        function destroyDatePicker(index, type) {
            if (type === 'from') {
                $(`#variationInputDateOnSaleFrom-${index}`).val(null);
                $(`#variationInputDateOnSaleFrom-alt-${index}`).val(null);
                dateTimePicker[index].from.touched = false;
                dateTimePicker[index].to.options = {
                    minDate: "new persianDate().unix()",
                    initialValue: false
                }
            @this.set(`variations.${index}.date_on_sale_from`, null, true);
            } else {
                $(`#variationInputDateOnSaleTo-${index}`).val(null);
                $(`#variationInputDateOnSaleTo-alt-${index}`).val(null);
                dateTimePicker[index].to.touched = false;
                dateTimePicker[index].from.options = {
                    maxDate: null,
                    initialValue: false
                }
            @this.set(`variations.${index}.date_on_sale_to`, null, true);
            }
            console.log(dateTimePicker);
        }
    </script>
@endpush
