@extends('admin.layout.MasterAdmin')
@section('title', 'لیست بنر ها')

@section('Content')
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
                            <li class="breadcrumb-item active">گالری تصاویر</li>
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

                <form action="{{ route('admin.galeries.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="col-md-6">
                            <input type="file" class="form-control form-control-lg" id="images" name="images[]"
                                onchange="preview_images();" multiple />
                        </div>
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-raised btn-info waves-effect" name='submit_image'
                                value="آپلود تصاویر" />
                        </div>


                    </div>
                </form>
            </div>
            <div class="row" id="image_preview"></div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <ul class="nav nav-tabs pl-0 pr-0">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#a2018">1402</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#b2019">1403</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="a2018">
                                <div class="row clearfix">

                                    @foreach ($galeries as $galery)
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <a href="javascript:void(0);" class="file">
                                                    <div class="hover">
                                                        <form
                                                            action="{{ route('admin.galeries.destroy', ['galery' => $galery->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                    <div class="image">
                                                        <img src="{{ url(env('GALERY_IMAGES_PATCH') . $galery->file_url) }}"
                                                            alt="img" class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        {{-- <p class="m-b-5 text-muted">img21545ds.jpg</p> --}}
                                                        <small> تاریخ آپلود <span
                                                                class="date">{{ Hekmatinasser\Verta\Verta::instance($galery->created_at)->format('Y/n/j') }}</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="tab-pane" id="b2019">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        function preview_images() {
            var total_file = document.getElementById("images").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='" + URL.createObjectURL(
                    event.target.files[i]) + "'></div>");
            }
        }
    </script>
@endpush
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
