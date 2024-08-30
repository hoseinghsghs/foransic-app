@section('title', 'لیست آزمایشگاه ها')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>مدیریت آزمایشگاه ها</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);"> مدیریت آزمایشگاه ها </a></li>
                        <li class="breadcrumb-item active"> آزمایشگاه ها</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- add laboratory -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-3 col-sm-6">
                                    <label>نام آزمایشگاه</label>
                                    <input type="text" name="name" wire:model.defer="name" class="form-control">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <label>استان</label>
                                    <input type="text" name="province" wire:model.defer="province" class="form-control">
                                    @error('province')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>مکان مستقل</label>
                                        <select data-placeholder="وضعیت" wire:model.live="place" class="form-control ms @error('place') is-invalid @enderror">
                                            <option value="1">دارد</option>
                                            <option value="0">ندارد</option>
                                        </select>
                                        @error('place')
                                        <div class="invalid-feedback">{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <label>شماره داخلی</label>
                                    <input type="text" name="internal_number" wire:model.defer="internal_number" class="form-control">
                                    @error('internal_number')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <label>تعداد پرسنل ثابت</label>
                                    <input type="text" name="permanent_personnel_count" wire:model.defer="permanent_personnel_count" class="form-control">
                                    @error('permanent_personnel_count')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <label>تعداد پرسنل پاره وقت</label>
                                    <input type="text" name="temporary_personnel_count" wire:model.defer="temporary_personnel_count" class="form-control">
                                    @error('temporary_personnel_count')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <label>تعداد لپتاپ</label>
                                    <input type="text" name="laptop_count" wire:model.defer="laptop_count" class="form-control">
                                    @error('laptop_count')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-sm-6">
                                    <label>تعداد تبلت</label>
                                    <input type="text" name="tablet_count" wire:model.defer="tablet_count" class="form-control">
                                    @error('tablet_count')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-sm-6 mt-3">
                                    <label>نسخه UFED For PC</label>
                                    <input type="text" name="version_ufed_for_pc" wire:model.defer="version_ufed_for_pc" class="form-control">
                                    @error('version_ufed_for_pc')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-sm-6 mt-3">
                                    <label>نسخه UFED p-Analyzer</label>
                                    <input type="text" name="version_ufed_analyzer" wire:model.defer="version_ufed_analyzer" class="form-control">
                                    @error('version_ufed_analyzer')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-sm-6 mt-3">
                                    <label>نسخه oxygen</label>
                                    <input type="text" name="version_oxygen" wire:model.defer="version_oxygen" class="form-control">
                                    @error('version_oxygen')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-sm-6 mt-3">
                                    <label>نسخه axiom</label>
                                    <input type="text" name="version_axiom" wire:model.defer="version_axiom" class="form-control">
                                    @error('version_axiom')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-sm-6 mt-3">
                                    <label>نسخه final mobile</label>
                                    <input type="text" name="version_final_mobile" wire:model.defer="version_final_mobile" class="form-control">
                                    @error('version_final_mobile')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12 @error('description') is-invalid @enderror mt-3">
                                    <label>سایر توضیحات</label>
                                    <div>
                                        <textarea class="form-control" rows="6" wire:model.defer="description">{!! $description !!}</textarea>
                                    </div>
                                    @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="col-auto">
                                    <button wire:click="add_laboratory" wire:loading.attr="disabled" class="btn btn-raised {{ $is_edit ? 'btn-warning' : 'btn-primary' }}  waves-effect">
                                        {{ $is_edit ? 'ویرایش' : 'افزودن' }}
                                        <span class="spinner-border spinner-border-sm text-light" wire:loading wire:target="add_laboratory"></span>
                                    </button>
                                    @if ($is_edit)
                                    <button class="btn btn-raised btn-info waves-effect" wire:loading.attr="disabled" wire:click="ref">صرف نظر
                                        <span class="spinner-border spinner-border-sm text-light" wire:loading wire:target="ref"></span>
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
                            <h2 style="display: inline;"><strong>لیست آزمایشگاه ها </strong>
                                ({{ $laboratories->total() }})
                            </h2>
                            @can('laboratories-export')
                                    <a style="float: left" onclick="loadbtn(event)" href="{{ route('admin.file-laboratories') }}"
                                       class="btn btn-raised btn-warning waves-effect ml-4 ">
                                        خروجی آزمایشگاه ها <i class="zmdi zmdi-developer-board mr-1"></i></a>
                                @endcan
                        </div>

                        <div class="body">
                            @if (count($laboratories) === 0)
                            <p>هیچ رکوردی وجود ندارد</p>
                            @else
                            <div class="table-responsive">
                                <table class="table table-hover c_table theme-color">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>عنوان</th>
                                            <th>استان</th>
                                            <th>مکان مستقل</th>
                                            <th>شماره داخلی</th>
                                            <th>تعداد پرسنل ثابت</th>
                                            <th>تعداد پرسنل پاره وقت</th>
                                            <th class="text-center js-sweetalert">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($laboratories as $laboratory)
                                        <tr wire:key="{{ $laboratory->id }}" wire:loading.attr="disabled">
                                            <td scope="row">{{ $loop->index + 1 }}</td>
                                            <td>{{ $laboratory->name }}</td>
                                            <td>{{ $laboratory->province }}</td>
                                            <td>{{ $laboratory->place ? "دارد" : "ندارد" }}</td>
                                            <td>{{ $laboratory->internal_number }}</td>
                                            <td>{{ $laboratory->permanent_personnel_count }}</td>
                                            <td>{{ $laboratory->temporary_personnel_count }}</td>
                                            <td class="text-center js-sweetalert">
                                                <button wire:click="edit_laboratory({{ $laboratory->id }})" wire:loading.attr="disabled" {{ $display }} class="btn btn-raised btn-info waves-effect scroll">
                                                    <i class="zmdi zmdi-edit"></i>
                                                    <span class="spinner-border spinner-border-sm text-light" wire:loading wire:target="edit_laboratory({{ $laboratory->id }}) "></span>
                                                </button>

                                                {{-- <button class="btn btn-raised btn-danger waves-effect"
                                                            wire:loading.attr="disabled"
                                                            wire:click="del_laboratory({{ $laboratory->id }})"
                                                wire:confirm="از حذف رکورد مورد نظر اطمینان دارید؟"
                                                {{ $display }}>
                                                <i class="zmdi zmdi-delete"></i>
                                                <span class="spinner-border spinner-border-sm text-light" wire:loading wire:target="del_laboratory({{ $laboratory->id }})"></span>
                                                </button>--}}
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
                        {{ $laboratories->onEachSide(1)->links() }}
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
