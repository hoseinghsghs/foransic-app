@section('title', 'ویرایش دیوایس')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>ویرایش دیوایس</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href={{ route('admin.devices.index') }}>لیست دیوایس ها </a></li>
                        <li class="breadcrumb-item active">ویرایش دیوایس</li>
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
                                                class="form-control ms select2 statusSelect">
                                                <option {{ $status == 'دریافت دیوایس' ? 'selected' : '' }}>دریافت دیوایس
                                                </option>
                                                <option {{ $status == 'در حال بررسی' ? 'selected' : '' }}>در حال بررسی
                                                </option>
                                                <option {{ $status == 'تکمیل بررسی' ? 'selected' : '' }}>تکمیل بررسی
                                                </option>
                                                <option {{ $status == 'تحویل دیوایس' ? 'selected' : '' }}>تحویل دیوایس
                                                </option>
                                            </select>
                                        </div>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- تحویل گیرنده --}}
                                <div class="row clearfix" id="rece_1" wire:ignore style="display: none">
                                    <div class="form-group col-md-6">
                                        <label> نام تحویل گیرنده</label>
                                        <div class="form-group">
                                            <input type="text" wire:model.defer="receiver_name" id="receiver-name"
                                                class="form-control @error('receiver_name') is-invalid @enderror"
                                                required />
                                            <span id="receiver-name-display" class="text-warning"></span>
                                            @error('receiver_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label> کد پرسنلی تحویل گیرنده</label>

                                        <div class="form-group">
                                            <input type="text" wire:model.defer="receiver_code" id="receiver_code"
                                                class="form-control @error('receiver_code') is-invalid @enderror"
                                                required />
                                            <span id="receiver_code-display" class="text-warning"></span>
                                            @error('receiver_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-md-4 col-sm-4 @error('use_id') is-invalid @enderror">
                                        <label for="userSelect">رده</label>
                                        <div wire:ignore>
                                            <select id="userSelect" name="user_category_id"
                                                data-placeholder="انتخاب رده" class="form-control ms search-select">
                                                <option></option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        {{ $device->user_category_id == $user->id ? 'selected' : '' }}>
                                                        {{ $user->cellphone }} {{ $user->name }}
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
                                        <label for="summernote">توضیحات</label>
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

            if ($(".statusSelect").val() == 'تحویل دیوایس') {
                $("#rece_1").show();
            } else {
                $("#rece_1").hide();
            }

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

        $(".statusSelect").change(function() {
            if ($(".statusSelect").val() == 'تحویل دیوایس') {
                $("#rece_1").show();
            } else {
                $("#rece_1").hide();
            }
        })
    </script>
@endpush
