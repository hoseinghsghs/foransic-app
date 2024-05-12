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
                                                    <div class="form-group col-md-12 col-sm-12 mt-2">
                                                        <span>
                                                            <h5 style="font-size:1.1em !important"><a class="ml-3"
                                                                                                      href="#">
                                                                    <strong style="color:#e47297">
                                                                        عنوان
                                                                    </strong>
                                                                    : {{ $device->category->title }}</a>
                                                                <a class="ml-3" href="#">
                                                                    <strong style="color:#e47297">
                                                                        سریال یا شماره اموال
                                                                        شواهد
                                                                        دیجیتال
                                                                    </strong>
                                                                    : {{ $device->code }}</a>
                                                                @if ($device->dossier)
                                                                    <a class="ml-3" href="#">
                                                                        <strong style="color:#e47297">عنوان پرونده
                                                                            مربوطه
                                                                            :
                                                                        </strong>
                                                                        {{ $device->dossier->name }},
                                                                    </a>
                                                                @endif
                                                                @if ($is_edit)
                                                                    <a class="ml-3" href="#">
                                                                        <strong style="color:#e47297">نام پرسنل :
                                                                        </strong>
                                                                        {{ $action->user->name }}
                                                                    </a>
                                                                    <a class="ml-3" href="#">
                                                                        <strong style="color:#e47297">
                                                                            آیدی اقدام :
                                                                        </strong>{{ $action->id }}
                                                                    </a>
                                                                @endif
                                                            </h5>
                                                        </span>
                                                    </div>
                                                    <div
                                                        class="form-group col-md-6 col-sm-12 @error('action_category_id') is-invalid @enderror">
                                                        <label for="categorySelect">عنوان اقدام <abbr
                                                                class="required text-danger"
                                                                title="ضروری">*</abbr></label>
                                                        <div wire:ignore>
                                                            <select id="categorySelect" data-placeholder="انتخاب عنوان"
                                                                    class="form-control ms search-select">
                                                                <option></option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->title }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @error('action_category_id')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12">
                                                        <label for="">توضیحات اقدام <abbr class="required text-danger"
                                                                                          title="ضروری">*</abbr></label>
                                                        @if ($is_edit)
                                                            <textarea rows="5"
                                                                      class="form-control @error('description') is-invalid @enderror"
                                                                      wire:model.defer="description">{!! $action->description !!}</textarea>
                                                        @else
                                                            <textarea rows="5"
                                                                      class="form-control @error('description') is-invalid @enderror"
                                                                      wire:model.defer="description">
                                                                </textarea>
                                                        @endif
                                                        @error('description')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label> تاریخ و زمان شروع <abbr class="required text-danger"
                                                                                        title="ضروری">*</abbr></label>
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
                                                        </div>
                                                        @error('start_date')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-3">
                                                        <label>تاریخ و زمان پایان <abbr class="required text-danger"
                                                                                        title="ضروری">*</abbr></label>
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
                                                        </div>
                                                        @error('end_date')
                                                        <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>وضعیت</label>
                                                            <select data-placeholder="وضعیت" wire:model.live="status"
                                                                    class="form-control ms @error('status') is-invalid @enderror">
                                                                <option value="1">فعال</option>
                                                                <option value="0">غیرفعال</option>
                                                            </select>
                                                            @error('status')
                                                            <div class="invalid-feedback">{{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>نمایش در گزارش و پرینت</label>
                                                            <select data-placeholder="وضعیت"
                                                                    wire:model.live="is_print"
                                                                    class="form-control ms @error('status') is-invalid @enderror">
                                                                <option value="1">فعال</option>
                                                                <option value="0">غیرفعال</option>
                                                            </select>
                                                            @error('is_print')
                                                            <div class="invalid-feedback">{{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="col-lg-12 col-md-12" wire:ignore>
                                                        <div class="header mt-0">
                                                            <label class="mb-1"> فایل ضمیمه</label>
                                                        </div>
                                                        <div class="form-group">
                                                            <form action="{{ route('admin.attachments_uploade') }}"
                                                                  id="myDropzone" class="dropzone" method="POST">
                                                                @csrf
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12">
                                                        <button wire:click="addAction" onclick="clear()"
                                                                wire:loading.attr="disabled"
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
                        <div class="header d-flex align-items-center">
                            <h2><strong>لیست اقدامات </strong>( {{ $actions->total() }} )</h2>
                            {{-- <div class="mr-auto">

                                <a onclick="loadbtn(event)" href="{{ route('admin.file-action') }}"
                                    class="btn btn-raised btn-warning waves-effect ml-4 ">
                                    خروجی اکسل <i class="zmdi zmdi-developer-board mr-1"></i></a>
                            </div> --}}
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
                                            <th>توضیحات - فایل ها</th>
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
                                                        <span class='badge badge-success'> فعال </span>
                                                    @else
                                                        <span class='badge badge-danger'>غیر فعال </span>
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
                                                            wire:confirm="از حذف رکورد مورد نظر اطمینان دارید؟"
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
                                                        <div class="modal-body">
                                                            <h5> توضیحات :</h5>
                                                            {{ $action->description }}
                                                            <h5 class="mt-3">فایل های ضمیمه :</h5>
                                                            @foreach ($action->attachments as $attachment)
                                                                <div>
                                                                    <a href="{{ env('APP_URL') }}/storage/attachment_files/{{ $attachment->url }}"
                                                                       target="_blank">{{ $attachment->url }}</a>
                                                                </div>
                                                            @endforeach
                                                        </div>
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
        </div>
        {{ $actions->onEachSide(1)->links() }}
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

        let dateTimePicker = {
            from: null,
            to: null
        }

        let myDropzone;
        // Dropzone upload file start
        Dropzone.options.myDropzone = {
            parallelUploads: 5,
            maxFiles: 5,
            maxFilesize: 1,
            acceptedFiles: ".zip,.rar,.jpeg,.jpg,.png,.pdf,.txt,.xlsx,.csv",
            addRemoveLinks: true,
            previewsContainer: ".dropzone",
            clickable: ".dropzone",
            success: function (file, response) {
                $(file.previewTemplate).append(
                    '<span class="server_file">' + file.name + "</span>"
                );
            },

            removedfile: function (file) {
                var server_file = $(file.previewTemplate)
                    .children(".server_file")
                    .text();
                if (confirm('فایل از اقدام مورد نظر حذف شود (فایل حذف شده قابل بازگردانی نیست)?')) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.attachments_del') }}",
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
                }
                ;
            },
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}",
            },
            dictDefaultMessage: "<span style='color:gray'>فایل ها را بکشید و در اینجا رها کنید</span>",
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
                // Makes sure that 'this' is understood inside the functions below.
                myDropzone = this;
                // for Dropzone to process the queue (instead of default form behavior):
                var el = document.getElementById("submit-all");
                if (el) {
                    el.addEventListener("click", function (e) {
                        // Make sure that the form isn't actually being sent.
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
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
        // uploade file end


        Livewire.on('edit-file', (data) => {
            let variations = data.attachments;
            variations.forEach(variation => {

                var mockFile = {
                    name: variation,
                    size: 12345,
                    type: '.zip,.rar,.jpeg,.jpg,.png,.pdf,.txt,.xlsx,.csv',

                };
                // myDropzone.files.push(mockFile);
                {{-- myDropzone.displayExistingFile(mockFile, "{{ env('APP_URL') }}" + '/storage/attachment_files/' + variation, null, '*'); --}}
                myDropzone.emit("addedfile", mockFile);
                myDropzone.emit("success", mockFile);
                if (!['jpeg', 'jpg', 'png'].includes(variation.split('.')
                    .pop())) {
                    myDropzone.emit("thumbnail", mockFile, "{{ env('APP_URL') }}" +
                        '/images/preview.png')

                } else {
                    myDropzone.emit("thumbnail", mockFile, "{{ env('APP_URL') }}" +
                        '/storage/attachment_files/' + variation)
                }

            },)
        })

        Livewire.on('upfile', () => {
            $('#myDropzone').empty();
        });


        function destroyDatePicker(type) {
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

        $(document).ready(function () {

            // عنوان اقدام
            $('#categorySelect').on('change', function (e) {
                let data = $('#categorySelect').select2("val");
            @this.set('action_category_id', data);
            });
            Livewire.on('eselect2', (data) => {
                $("#categorySelect").select2().val(data.catg).trigger("change");
            })
            Livewire.on('resetselect2', () => {
                $("#categorySelect").val('0').trigger('change')
            });

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
                altFieldFormatter: function (unixDate) {
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
                onSelect: function (unix) {
                    dateTimePicker.from.touched = true;
                    if (dateTimePicker.to && dateTimePicker.to.options && dateTimePicker.to.options
                        .minDate != unix) {
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
                altFieldFormatter: function (unixDate) {
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
                onSelect: function (unix) {
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
