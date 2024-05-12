@section('title', 'فیلم راهنما')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>گالری </h2>
                        </br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item active">فیلم آموزشی </li>
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
                <form wire:submit="save">
                    @csrf
                    <div class="form-group col-md-6">
                        <label class="form-label" for="exampleFormControlFile1">آپلود فیلم<span
                                wire:loading wire:target="vid" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true"></span></label>
                        <div class="custom-file d-flex flex-row-reverse">
                            <input wire:model.live="vid" type="file" class="custom-file-input"
                                id="customFile" lang="ar" dir="rtl">
                            <label class="custom-file-label text-right" for="customFile">
                                </label>
                        </div>
                    </div>
                    <div class="col-12">
                         <button type="submit" wire:loading.attr="disabled"
                            class="btn btn-raised btn-primary waves-effect">
                            ذخیره
                            <span wire:loading class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span>
                          </button>
                    </div>
                </form>
            </div>
            <div class="row" id="image_preview"></div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="tab-content">
                            <div class="tab-pane active" id="a2018">
                                <div class="row clearfix">
                                    @foreach ($videos as $video)
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a  class="file" target="_blank">
                                                    <div class="hover">
                                                        <form wire:submit="delete({{$video}})" style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </form>
                                                            <span class="file-name">
                                                                {{-- <p class="m-b-5 text-muted">img21545ds.jpg</p> --}}
                                                                <small class="mr-2"> تاریخ آپلود <span
                                                                        class="date">{{ Hekmatinasser\Verta\Verta::instance($video->created_at)->format('Y/n/j') }}</span></small>
                                                            </span>
                                                       
                                                        </div>
                                                        <video width="320" height="240" controls>
                                                            <source src="{{ url(env('GUIDE_VIDEO_PATCH') . $video->url) }}" type="video/mp4">
                                                        </video>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div style="float: right;">
                            {{ $videos->onEachSide(1)->links() }}
                            </div>
                        </div>
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

        #video {
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

        .previewBox video {
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

