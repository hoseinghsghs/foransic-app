@extends('admin.layout.MasterAdmin')
@section('title', 'لیست رویداد ها')
@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2> تولید QR کد </h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item active">ابزار ها</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input id="text" type="text" class="form-control" style="width:80%" /><br />
                    </div>
                    <div id="qrcode" style="width:200px; height:200px; margin-top:15px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script type="text/javascript" src="{{asset('vendor/qrcode.js')}}"></script>
<script type="text/javascript">
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width: 100,
        height: 100
    });

    function makeCode() {
        var elText = document.getElementById("text");

        if (!elText.value) {
            elText.focus();
            return;
        }
        qrcode.makeCode(elText.value);
    }
    makeCode();
    $("#text").
    on("blur", function() {
        makeCode();
    }).
    on("keydown", function(e) {
        if (e.keyCode == 13) {
            makeCode();
        }
    });
</script>
@endpush
@endsection