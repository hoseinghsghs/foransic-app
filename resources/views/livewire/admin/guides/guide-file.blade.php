@section('title', 'فایل های آموزش')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>فایل ها </h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item active">فایل ها</li>
                    </ul>
                    </br>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                            class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                            class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        @can('guides-file-create')
            <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="card">
                            <div class="body">
                                <form wire:submit="save">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="exampleFormControlFile1">آپلود فایل<span
                                                    wire:loading wire:target="fil"
                                                    class="spinner-border spinner-border-sm" role="status"
                                                    aria-hidden="true"></span></label>
                                            <div class="custom-file d-flex flex-row-reverse">
                                                <input wire:model="fil" type="file" class="custom-file-input"
                                                       id="customFile" lang="ar" dir="rtl" multiple>
                                                <label class="custom-file-label text-right" for="customFile">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>عنوان یا دسته<abbr class="required" title="ضروری" style="color:red;">*</abbr></label>
                                            <div class="form-group">
                                                <input type="text" wire:model.defer="category" id="category"
                                                       class="form-control @error('category') is-invalid @enderror"
                                                       required/>
                                                <span id="category-display" class="text-warning"></span>
                                                @error('category')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    {{-- @if ($fil)
                                            @foreach ($fil as $file)
                                             <a href="{{ $file->temporaryUrl() }}">
                                    @endforeach

                                    @endif --}}
                                    <div class="col-12">
                                        <button type="submit" wire:loading.attr="disabled"
                                                class="btn btn-raised {{ $is_edit ? 'btn-warning' : 'btn-primary' }}  waves-effect">
                                            {{ $is_edit ? 'ویرایش' : 'افزودن' }}
                                            <span class="spinner-border spinner-border-sm text-light" wire:loading
                                                  wire:target="add_image"></span>
                                        </button>
                                        @if ($is_edit)
                                            <button class="btn btn-raised btn-info waves-effect"
                                                    wire:loading.attr="disabled" wire:click="ref">صرف نظر
                                                <span class="spinner-border spinner-border-sm text-light" wire:loading
                                                      wire:target="ref"></span>
                                            </button>
                                        @endif
                                        <span wire:loading class="spinner-border spinner-border-sm" role="status"
                                              aria-hidden="true"></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>لیست فایل ها </strong>
                                ({{ $guides->total() }})
                            </h2>
                        </div>
                        <div class="body">
                            @if (count($guides) === 0)
                                <p class="text-right">هیچ رکوردی وجود ندارد</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover c_table theme-color">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>لینک دانلود</th>
                                            <th>عنوان</th>
                                            <th>نام فایل</th>
                                            <th>تاریخ آپلود</th>
                                            <th class="text-center js-sweetalert">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($guides as $guide)
                                            <tr wire:key="{{ $guide->id }}" wire:loading.attr="disabled">
                                                <td scope="row">{{ $loop->index + 1 }}</td>
                                                <td><a href="{{ url(env('GUIDE_FILE_PATCH') . $guide->url) }}"
                                                       class="btn btn-success">دانلود</span></td>
                                                <td>{{$guide->category}}</td>
                                                <td>{{$guide->url}}</td>
                                                <td>{{ Hekmatinasser\Verta\Verta::instance($guide->created_at)->format('Y/n/j') }}</td>
                                                <td class="text-center">
                                                    @can('guides-file-delete')
                                                        <form wire:submit="delete({{$guide}})" style="display: inline"
                                                              class="ml-3">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    @endcan
                                                    @can('guides-file-edit')
                                                        <button wire:click="edit_file({{ $guide->id }})"
                                                                wire:loading.attr="disabled"
                                                                {{ $display }} class="btn btn-icon btn-warning btn-icon-mini btn-round scroll">
                                                            <i class="zmdi zmdi-edit"></i>
                                                            <span class="spinner-border spinner-border-sm text-light"
                                                                  wire:loading
                                                                  wire:target="edit_file({{ $guide->id }}) "></span>
                                                        </button>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    {{ $guides->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@push('styles')
    <style>
        #formdiv {
            text-align: center;
        }

        #file {
            color: green;
            padding: 5px;
            border: 1px dashed #123456;
            background-color: #f9ffe5;
        }

        #img {
            width: 17px;
            border: none;
            height: 17px;
            margin-left: -20px;
            margin-bottom: 191px;
        }

        .upload {
            width: 100%;
            height: 30px;
        }

        .previewBox {
            text-align: center;
            position: relative;
            width: 150px;
            height: 150px;
            margin-right: 10px;
            margin-bottom: 20px;
            float: left;
        }

        .previewBox img {
            height: 150px;
            width: 150px;
            padding: 5px;
            border: 1px solid rgb(232, 222, 189);
        }

        .delete {
            color: red;
            font-weight: bold;
            position: absolute;
            top: 0;
            cursor: pointer;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #ccc;
        }
    </style>
@endpush
