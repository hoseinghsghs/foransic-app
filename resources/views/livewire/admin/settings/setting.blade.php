@section('title','تنظیمات سایت')
@push('styles')
    <style>
        .custom-file-label::after {
            left: 0;
            right: auto;
            border-left-width: 0;
            border-right: inherit;
        }

        .preview-img {
            max-height: 18em;
        }
    </style>
@endpush
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>تنظیمات</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i> خانه</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">تنظیمات</a></li>
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
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form wire:submit="save" id="form_advanced_validation">
                                @csrf
                                <div class="row">
                                    <div class="form-group form-float col-md-4">
                                        <div class="form-line">
                                            <label class="form-label">عنوان سایت</label>
                                            <input wire:model="site_name" type="text" name="title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12" wire:ignore>
                                        <label class="form-label">نام دستگاه/قطعه ها</label>
                                        <input id="device-names" value="{{$device_names}}" class="form-control"
                                               data-role="tagsinput">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="exampleFormControlFile1">آپلود لوگوی پنل<span
                                                wire:loading
                                                wire:target="logo"
                                                class="spinner-border spinner-border-sm"
                                                role="status"
                                                aria-hidden="true"></span></label>
                                        <div class="custom-file d-flex flex-row-reverse">
                                            <input wire:model.live="logo" type="file" class="custom-file-input"
                                                   id="customFile" lang="ar"
                                                   dir="rtl">
                                            <label class="custom-file-label text-right" for="customFile">انتخاب
                                                عکس</label>
                                        </div>
                                        @if ($logo || $logo_url)
                                            <img
                                                src="{{ isset($logo) ? $logo->temporaryUrl() : asset('storage/logo/'.$logo_url) }}"
                                                class="rounded mx-auto d-block img-fluid img-thumbnail preview-img mt-2">
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" wire:loading.attr="disabled"
                                        class="btn btn-raised btn-primary waves-effect">
                                    ذخیره
                                    <span wire:loading class="spinner-border spinner-border-sm" role="status"
                                          aria-hidden="true"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#device-names').on('itemAdded', function (event) {
                // Livewire.emit('keywordsChanged', $(this).val());
            @this.set('device_names', $(this).val());
            });
        });
    </script>
@endpush
