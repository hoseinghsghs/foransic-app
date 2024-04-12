@section('title', 'ایجاد دستگاه / قطعه')
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
                        <li class="breadcrumb-item"><a href={{ route('admin.devices.index') }}>لیست پرونده ها </a>
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
                                    <label>نام پرونده یا کیس *</label>
                                    <div class="form-group">
                                        <input type="text" wire:model.defer="name"
                                            class="form-control @error('name') is-invalid @enderror" required />
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>موضوع *</label>

                                    <div class="form-group">
                                        <input type="text" wire:model.defer="subject" id="subject"
                                            class="form-control @error('subject') is-invalid @enderror" required />
                                        <span id="subject-display" class="text-warning"></span>
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label> شماره پرونده * </label>
                                    <div class="form-group">
                                        <input type="text" wire:model.defer="number_dossier" id="number_dossier"
                                            class="form-control @error('number_dossier') is-invalid @enderror"
                                            required />
                                        <span id="number_dossier-display" class="text-warning"></span>
                                        @error('number_dossier')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="form-group col-md-3 col-sm-3 @error('status') is-invalid @enderror">
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
                                </div> --}}

                                {{--
                                <div class="form-group col-md-4 col-sm-4 @error('use_id') is-invalid @enderror">
                                    <label for="userSelect">رده</label>
                                    <div wire:ignore>
                                        <select id="userSelect" name="user_category_id" data-placeholder="انتخاب رده"
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
                                </div> --}}

                                <div class="form-group col-md-5">
                                    <label>مدیریت یا معاونت * </label>
                                    <div class="form-group">
                                        <input type="text" wire:model.defer="section" id="delivery-name"
                                            class="form-control @error('section') is-invalid @enderror" required />
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
                                    <label for="summernote">خلاصه پرونده *</label>
                                    <div wire:ignore>
                                        <textarea class="form-control summernote-editor" id="summernote"></textarea>
                                    </div>
                                    @error('summary_description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>


                            <div class="row clearfix">
                                <div class="form-group col-md-12 @error('expert') is-invalid @enderror">
                                    <label>درخواست کارشناس پرونده از آزمایشگاه</label>
                                    <div>
                                        <textarea class="form-control" rows="6" wire:model.defer="expert"></textarea>
                                    </div>
                                    @error('expert')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
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
    <script>
        $(document).ready(function() {
            $('#is_active').on('change', function(e) {
                let data = $('#is_active').select2("val");
                @this.set('is_active', data);
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
                @this.set('summary_description', contents);
            });
        });
    </script>
@endpush
