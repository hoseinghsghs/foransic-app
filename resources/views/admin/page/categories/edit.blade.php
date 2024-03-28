@extends('admin.layout.MasterAdmin')
@section('title', 'ویرایش دسته بندی')
@section('Content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>ویرایش دسته بندی</h2>
                        </br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">دسته بندی ها</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $category->name }}</li>
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
                <!-- Hover Rows -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                <div class="container">
                                    <div class="alert-icon">
                                        <i class="zmdi zmdi-block"></i>
                                    </div>
                                    {{ $error }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="zmdi zmdi-close"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                        <div class="card">
                            <div class="body">
                                <form id="form_advanced_validation" class="needs-validation"
                                    action={{ route('admin.categories.update', $category->id) }} method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <label for="name">عنوان دسته بندی</label>
                                            <div class="form-group">
                                                <input type="text" name="name" id="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name') ?? $category->name }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <label for="slug">عنوان انگلیسی</label>
                                            <div class="form-group">
                                                <input type="text" name="slug" id="slug"
                                                    class="form-control @error('slug') is-invalid @enderror"
                                                    value="{{ old('slug') ?? $category->slug }}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            @if ($category->products->isEmpty() && $category->children->isEmpty())
                                                <label for="parent_id">والد</label>
                                                <div class="form-group">
                                                    <select id="parent_id" name="parent_id"
                                                        class="form-control show-tick ms select2-styled" required>
                                                        <option value="0" class="font-weight-bold">بدون والد</option>
                                                        @foreach ($parentCategories as $parentCategory)
                                                            <option class="font-weight-bold"
                                                                {{ old('parent_id') == $parentCategory->id || $category->parent_id === $parentCategory->id ? 'selected' : null }}
                                                                value="{{ $parentCategory->id }}">
                                                                {{ $parentCategory->name }}</option>
                                                            @if ($parentCategory->children->count() > 0)
                                                                @foreach ($parentCategory->children as $childCategory)
                                                                    <option class="pr-2"
                                                                        {{ old('parent_id') == $childCategory->id || $category->parent_id === $childCategory->id ? 'selected' : null }}
                                                                        value="{{ $childCategory->id }}">&#8617;
                                                                        {{ $childCategory->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @else
                                                <label for="parent_id">والد <small class="text-danger">(امکان تغییر وجود
                                                        ندارد)</small></label>
                                                <div class="form-group">
                                                    <select id="parent_id" disabled
                                                        class="form-control show-tick ms select2">
                                                        <option value="0"> بدون والد</option>
                                                        @foreach ($parentCategories as $parentCategory)
                                                            @continue($parentCategory->id == $category->id)
                                                            <option
                                                                {{ old('parent_id') === $parentCategory->id || $category->parent_id === $parentCategory->id ? 'selected' : null }}
                                                                value="{{ $parentCategory->id }}">
                                                                {{ $parentCategory->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <label for="switch">وضعیت</label>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="is_active" id="switch" value="active"
                                                    {{ ($errors->any() && !old('is_active')) || !$category->is_active ? 'checked' : null }}>
                                                <label for="switch">Toggle</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <label for="attributesId">ویژگی</label>
                                            <div class="form-group">
                                                <select id="attributesId" name="attribute_ids[]"
                                                    class="form-control show-tick ms select2"
                                                    data-placeholder="انتخاب ویژگی" data-close-on-select="false" multiple
                                                    required>
                                                    @foreach ($attributes as $attribute)
                                                        <option value="{{ $attribute->id }}"
                                                            @php if(old('attribute_ids')){
                                                    if(in_array($attribute->id, old('attribute_ids'))) echo "selected";
                                                    }
                                                    elseif($category->attributes){
                                                    if(in_array($attribute->id,
                                                    $category->attributes()->pluck('id')->toArray())) echo "selected";
                                                    } @endphp>
                                                            {{ $attribute->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <label for="attributeIsFilter">انتخاب ویژگی های قابل فیلتر</label>
                                            <div class="form-group">
                                                <select id="attributeIsFilter" name="attribute_is_filter_ids[]"
                                                    class="form-control show-tick ms select2"
                                                    data-placeholder="انتخاب فیلتر" data-close-on-select="false" multiple
                                                    required>
                                                    @if (old('attribute_ids') && old('attribute_is_filter_ids'))
                                                        @foreach ($attributes->only(old('attribute_ids')) as $selected_attribute)
                                                            <option value="{{ $selected_attribute->id }}"
                                                                {{ in_array($selected_attribute->id, old('attribute_is_filter_ids')) ? 'selected' : null }}>
                                                                {{ $selected_attribute->name }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach ($category->attributes as $attribute)
                                                            <option value="{{ $attribute->id }}"
                                                                {{ in_array($attribute->id,$category->attributes()->wherePivot('is_filter', 1)->pluck('id')->toArray())? 'selected': null }}>
                                                                {{ $attribute->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div @if ($category->parent_id == 0) style="display: none" @endif
                                            class="sub-feature col-lg-3 col-md-4 col-sm-6">
                                            <label for="attributeIsMain">انتخاب ویژگی های اصلی دسته</label>
                                            <div class="form-group">
                                                <select id="attributeIsMain" name="attribute_is_main_ids[]"
                                                    class="form-control show-tick ms select2" multiple
                                                    data-close-on-select="false" data-placeholder="انتخاب ویژگی">
                                                    @if (old('attribute_ids') && old('attribute_is_main_ids'))

                                                        @foreach ($attributes->only(old('attribute_ids')) as $selected_attribute)
                                                            <option value="{{ $selected_attribute->id }}"
                                                                {{ in_array($selected_attribute->id, old('attribute_is_main_ids')) ? 'selected' : null }}>
                                                                {{ $selected_attribute->name }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach ($category->attributes as $attribute)
                                                            <option value="{{ $attribute->id }}"
                                                                {{ in_array($attribute->id,$category->attributes()->wherePivot('is_main', 1)->pluck('id')->toArray())? 'selected': null }}>
                                                                {{ $attribute->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div @if ($category->parent_id == 0) style="display: none" @endif
                                            class="sub-feature col-lg-3 col-md-4 col-sm-6">
                                            <label for="attributeVariation">انتخاب ویژگی متغیر</label>
                                            <div class="form-group">
                                                <select id="attributeVariation" name="variation_id"
                                                    class="form-control show-tick ms select2">
                                                    @if (old('attribute_ids') && old('variation_id'))
                                                        @foreach ($attributes->only(old('attribute_ids')) as $selected_attribute)
                                                            <option value="{{ $selected_attribute->id }}"
                                                                {{ $selected_attribute->id == old('variation_id') ? 'selected' : null }}>
                                                                {{ $selected_attribute->name }}</option>
                                                        @endforeach
                                                    @elseif($category->attributes()->wherePivot('is_variation', 1)->get()->isNotEmpty())
                                                        @foreach ($category->attributes as $attribute)
                                                            <option value="{{ $attribute->id }}"
                                                                {{ $attribute->id ==$category->attributes()->wherePivot('is_variation', 1)->first()->id? 'selected': null }}>
                                                                {{ $attribute->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <label for="icon">آیکن</label>
                                            <small> <a href="https://fontawesome.com/v3/icons/" target="_blank">
                                                    انتخاب نام آیکن</a></small>
                                            <div class="form-group">
                                                <input type="text" name="icon" id="icon" class="form-control"
                                                    value="{{ old('icon') ?? $category->icon }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6 align-self-center">
                                            <div class="checkbox">
                                                <input id="check" type="checkbox"
                                                    {{ $category->is_show === 1 ? 'checked' : '' }} name="is_show" />
                                                <label for="check">نمایش در صفحه اصلی </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="decription">توضیحات</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea rows="4" name="description" class="form-control no-resize"
                                                        placeholder="لطفا آنچه را که میخواهید تایپ کنید...">{{ old('description') ?? $category->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="title">عنوان</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="title" id="title"
                                                        class="form-control"
                                                        value="{{ old('title') ?? $category->title }}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-raised btn-primary waves-effect">ذخیره
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Hover Rows -->
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $('#attributesId').on('change', function() {
            let selectedAttributes = $(this).select2('data');
            let options = ''

            selectedAttributes.forEach(element => {
                options += `<option value="${element.id}">${element.text}</option>`
            });
            $('#attributeIsFilter').html(options).trigger('change');
            $('#attributeVariation').html(options).trigger('change');
            $('#attributeIsMain').html(options).trigger('change');
        })
        $('#parent_id').on('change', function() {
            let parent_id = $(this).select2('data');
            if (parent_id[0].id !== '0') {
                $('.sub-feature').show();
                $('#attributeVariation').prop('required', true);
            } else {
                $('.sub-feature').hide();
                $('#attributeVariation').prop('required', false);
            }
        })
        $(document).ready(function() {
            if ($('#parent_id').select2('data')[0].id !== '0') {
                $('.sub-feature').show();
                $('#attributeVariation').prop('required', true);
            }
        });
    </script>
@endpush
