    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>اضافه کردن عنوان</h2>
                        </br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);"> عناوین</a></li>
                            <li class="breadcrumb-item active">عنوان جدید</li>
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
                <div>
                    <!-- Hover Rows -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-md-4 col-sm-6">
                                            <input type="text" placeholder="عنوان" name="title"
                                                wire:model.defer="title" class="form-control">
                                            @error('titleg_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-auto">
                                            <button wire:click="addTitle_management" wire:loading.attr="disabled"
                                                class="btn btn-raised {{ $is_edit ? 'btn-warning' : 'btn-primary' }}  waves-effect">
                                                {{ $is_edit ? 'ویرایش' : 'افزودن' }}
                                                <span class="spinner-border spinner-border-sm text-light" wire:loading
                                                    wire:target="addTitle_management"></span>
                                            </button>
                                            @if ($is_edit)
                                                <button class="btn btn-raised btn-info waves-effect"
                                                    wire:loading.attr="disabled" wire:click="ref">صرف نظر
                                                    <span class="spinner-border spinner-border-sm text-light"
                                                        wire:loading wire:target="ref"></span>
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Hover Rows -->
                    <!-- لیست -->
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <h2><strong>لیست عناوین </strong>
                                        {{ $title_managements->total() }}
                                    </h2>
                                </div>
                                <div class="body">
                                    @if (count($title_managements) === 0)
                                        <p>هیچ رکوردی وجود ندارد</p>
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-hover c_table theme-color">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>عنوان</th>
                                                        <th class="text-center js-sweetalert">عملیات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($title_managements as $title_management)
                                                        <tr wire:key="{{ $title_management->title }} {{ $title_management->id }}"
                                                            wire:loading.attr="disabled">
                                                            <td scope="row">{{ $title_management->id }}</td>
                                                            <td>{{ $title_management->title }}</td>
                                                            <td class="text-center js-sweetalert">

                                                                <button
                                                                    wire:click="edit_title_management({{ $title_management->id }})"
                                                                    wire:loading.attr="disabled" {{ $display }}
                                                                    class="btn btn-raised btn-info waves-effect scroll">
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                    <span
                                                                        class="spinner-border spinner-border-sm text-light"
                                                                        wire:loading
                                                                        wire:target="edit_title_management({{ $title_management->id }}) "></span>
                                                                </button>

                                                                <button class="btn btn-raised btn-danger waves-effect"
                                                                    wire:loading.attr="disabled"
                                                                    wire:click="del_title_management({{ $title_management->id }})"
                                                                    {{ $display }}>
                                                                    <i class="zmdi zmdi-delete"></i>

                                                                    <span
                                                                        class="spinner-border spinner-border-sm text-light"
                                                                        wire:loading
                                                                        wire:target="del_title_management({{ $title_management->id }})"></span>
                                                                </button>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- پایان لیست -->
                </div>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            {{ $title_managements->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            $('.scroll').click(function() {
                $("html, body").animate({
                    scrollTop: 0
                }, 600);
                return false;
            });
        </script>
    @endpush
