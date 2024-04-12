@section('title', 'ویرایش دستگاه / قطعه')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>ویرایش دستگاه / قطعه</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href={{ route('admin.devices.index') }}>لیست دستگاه / قطعه ها </a>
                        </li>
                        <li class="breadcrumb-item active">ویرایش دستگاه / قطعه</li>
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
                                    <h2><strong>اطلاعات اصلی دستگاه / قطعه</strong></h2>
                                </div>
                                <hr>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <label>نام دستگاه / قطعه *</label>
                                        <div class="form-group">
                                            <input type="text" wire:model.defer="name"
                                                class="form-control @error('name') is-invalid @enderror" required />
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label> سریال یا شماره اموال دستگاه / قطعه</label>
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
                                                class="form-control ms select2 statusSelect">
                                                <option value="0" @selected($status == '0')>پذیرش دستگاه / قطعه
                                                </option>
                                                <option value="1" @selected($status == '1')>در حال بررسی
                                                </option>
                                                <option value="2" @selected($status == '2')> تکمیل تجزیه و تحلیل
                                                </option>
                                                <option value="3" @selected($status == '3')>تحویل دستگاه / قطعه
                                                </option>
                                            </select>
                                        </div>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    {{-- تحویل گیرنده --}}
                                    @if ($status == '3')
                                        <div class="form-group col-md-6">
                                            <label> نام تحویل گیرنده</label>
                                            <div class="form-group">
                                                <input type="text" wire:model.defer="receiver_name"
                                                    id="receiver-name"
                                                    class="form-control @error('receiver_name') is-invalid @enderror" />
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
                                                    class="form-control @error('receiver_code') is-invalid @enderror" />
                                                <span id="receiver_code-display" class="text-warning"></span>
                                                @error('receiver_code')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="row clearfix">

                                    <div class="form-group col-md-4 col-sm-4 @error('use_id') is-invalid @enderror">
                                        <label for="userSelect">الحاق به پرونده</label>
                                        <div wire:ignore>
                                            <select id="userSelect" name="dossier_id" data-placeholder="انتخاب پرونده"
                                                class="form-control ms search-select">
                                                <option></option>
                                                @foreach ($dossiers as $dossier)
                                                    <option value="{{ $dossier->id }}" @selected($device->dossier_id == $dossier->id)>
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
                                    <div class="form-group col-md-12 @error('trait') is-invalid @enderror">
                                        <label> مشخصات (ظرفیت ، مدل و...) *</label>
                                        <div>
                                            <textarea class="form-control" rows="6" wire:model.defer="trait">{!! $trait !!}</textarea>
                                        </div>
                                        @error('trait')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="form-group col-md-12 @error('accessories') is-invalid @enderror">
                                        <label> لوازم جانبی *</label>
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

                                <div class="row clearfix">
                                    <div class="form-group col-md-12 @error('description') is-invalid @enderror">
                                        <label for="summernote">توضیحات و اظهارات درخواست کننده :</label>
                                        <div wire:ignore>
                                            <textarea class="form-control summernote-editor" id="summernote">
                                            {!! $description !!}
                                        </textarea>
                                        </div>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" wire:loading.attr="disabled"
                                        class="btn btn-raised btn-success waves-effect"><i wire:loading
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

@push('scripts')
    <!-- dropzone script start -->
    <script>
        $(document).ready(function() {
            $('#statusSelect').on('change', function(e) {
                let data = $('#statusSelect').select2("val");
                @this.set('status', data);
            });

            $('#userSelect').on('change', function(e) {
                let data = $('#userSelect').select2("val");
                if (data === '') {
                    @this.set('dossier_id', null);
                } else {
                    @this.set('dossier_id', data);
                }
            });
            $('#summernote').on('summernote.change', function(we, contents, $editable) {
                @this.set('description', contents);
            });
        });
    </script>
@endpush
