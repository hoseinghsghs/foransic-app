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
            <!-- add category -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-4 col-sm-6">
                                    <input type="text" placeholder="عنوان" name="title"
                                           wire:model.defer="title" class="form-control">
                                    @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-auto">
                                    <button wire:click="add_category" wire:loading.attr="disabled"
                                            class="btn btn-raised {{ $is_edit ? 'btn-warning' : 'btn-primary' }}  waves-effect">
                                        {{ $is_edit ? 'ویرایش' : 'افزودن' }}
                                        <span class="spinner-border spinner-border-sm text-light" wire:loading
                                              wire:target="add_category"></span>
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
                                ({{ $categories->total() }})
                            </h2>
                        </div>
                        <div class="body">
                            @if (count($categories) === 0)
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
                                        @foreach ($categories as $category)
                                            <tr wire:key="{{ $category->id }}"
                                                wire:loading.attr="disabled">
                                                <td scope="row">{{ $loop->index + 1 }}</td>
                                                <td>{{ $category->title }}</td>
                                                <td class="text-center js-sweetalert">
                                                    <button
                                                        wire:click="edit_category({{ $category->id }})"
                                                        wire:loading.attr="disabled" {{ $display }}
                                                        class="btn btn-raised btn-info waves-effect scroll">
                                                        <i class="zmdi zmdi-edit"></i>
                                                        <span
                                                            class="spinner-border spinner-border-sm text-light"
                                                            wire:loading
                                                            wire:target="edit_category({{ $category->id }}) "></span>
                                                    </button>

                                                    <button class="btn btn-raised btn-danger waves-effect"
                                                            wire:loading.attr="disabled"
                                                            wire:click="del_category({{ $category->id }})"
                                                            wire:confirm="از حذف رکورد مورد نظر اطمینان دارید؟"
                                                        {{ $display }}>
                                                        <i class="zmdi zmdi-delete"></i>
                                                        <span
                                                            class="spinner-border spinner-border-sm text-light"
                                                            wire:loading
                                                            wire:target="del_category({{ $category->id }})"></span>
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
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        {{ $categories->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <script>
        $('.scroll').click(function () {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    </script>
@endpush
