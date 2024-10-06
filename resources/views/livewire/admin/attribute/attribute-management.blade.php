@section('title', 'ویژگی دسته بندی')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>ویژگی دسته بندی</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">شواهد دیجیتال </a></li>
                        <li class="breadcrumb-item active">ویژگی</li>
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
            <!-- add attribute -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" placeholder="عنوان ویژگی" name="name"
                                        wire:model.defer="name" class="form-control">
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group form-float col-md-6">
                                    <div class="input-group mb-1">
                                        <input wire:model.defer="def_value" placeholder="مقدار ویژگی" type="text" class="form-control without-spin">
                                        <div class="input-group-append">
                                            <button wire:click="addDef_values" wire:loading.attr="disabled" wire:target="addDef_values"
                                                class="btn btn-info m-0" type="button">
                                                <strong>افزودن</strong>
                                                <span wire:loading wire:target="addDef_values"
                                                    class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </div>
                                    @isset($def_values)
                                    @foreach($def_values as $index=>$def_value)
                                    <div class="input-group mb-1" wire:key="def_value-{{$index}}">
                                        <input type="text" class="form-control" value="{{$def_value}}" readonly>
                                        <div class="input-group-append">
                                            <button wire:click="removeDef_values({{$index}})" wire:loading.attr="disabled"
                                                wire:target="removeDef_values({{$index}})" type="button"
                                                class="btn btn-warning m-0"><i wire:target="removeDef_values({{$index}})"
                                                    wire:loading.remove
                                                    class="zmdi zmdi-delete"></i>
                                                <span wire:loading wire:target="removeDef_values({{$index}})"
                                                    class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true"></span>
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endisset
                                </div>
                                <div class="col-auto">
                                    <button wire:click="add_attribute" wire:loading.attr="disabled"
                                        class="btn btn-raised {{ $is_edit ? 'btn-warning' : 'btn-primary' }} waves-effect" style="padding: 8px 20px; font-size: 0.8rem;">
                                        {{ $is_edit ? 'ویرایش' : 'ثبت' }}
                                        <span class="spinner-border spinner-border-sm text-light" wire:loading
                                            wire:target="add_attribute"></span>
                                    </button>
                                    @if ($is_edit)
                                    <button class="btn btn-raised btn-info waves-effect"
                                        wire:loading.attr="disabled" wire:click="ref">صرف نظر
                                        <span class="spinner-border spinner-border-sm text-light" wire:loading
                                            wire:target="ref"></span>
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
                                ({{ $attributes->total() }})
                            </h2>
                        </div>
                        <div class="body">
                            @if (count($attributes) === 0)
                            <p>هیچ رکوردی وجود ندارد</p>
                            @else
                            <div class="table-responsive">
                                <table class="table table-hover c_table theme-color">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>عنوان</th>
                                            <th>مقادیر ویژگی</th>
                                            <th class="text-center js-sweetalert">عملیات</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($attributes as $attribute)
                                            <tr wire:key="{{ $attribute->id }}" wire:loading.attr="disabled">
                                            <td scope="row">{{ $loop->index + 1 }}</td>
                                            <td>{{ $attribute->name }}</td>
                                            <td>
                                                @if($attribute->def_values)
                                                @foreach(json_decode($attribute->def_values, true) as $def_valuee)
                                                {{$def_valuee}},
                                                @endforeach
                                                @endif
                                            </td>
                                            <td class="text-center js-sweetalert">
                                                <button wire:click="edit_attribute({{ $attribute->id }})"
                                                    wire:loading.attr="disabled" {{ $display }}
                                                    class="btn btn-raised btn-info waves-effect scroll">
                                                    <i class="zmdi zmdi-edit"></i>
                                                    <span class="spinner-border spinner-border-sm text-light"
                                                        wire:loading
                                                        wire:target="edit_attribute({{ $attribute->id }}) "></span>
                                                </button>

                                                <button class="btn btn-raised btn-danger waves-effect"
                                                    wire:loading.attr="disabled"
                                                    wire:click="del_attribute({{ $attribute->id }})"
                                                    wire:confirm="از حذف رکورد مورد نظر اطمینان دارید؟"
                                                    {{ $display }}>
                                                    <i class="zmdi zmdi-delete"></i>
                                                    <span class="spinner-border spinner-border-sm text-light"
                                                        wire:loading
                                                        wire:target="del_attribute({{ $attribute->id }})"></span>
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
                        {{ $attributes->onEachSide(1)->links() }}
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
