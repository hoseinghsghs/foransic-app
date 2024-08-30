@extends('admin.layout.MasterAdmin')
@section('title', 'تبدیل واحد ها')
@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>تبدیل واحد ها</h2>
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


                    <div class="container my-5">
                        <div class="row">
                            <div class="col-md-4 mb-5">
                                <div class="card">
                                    <h5 class="card-header"><i class="fas fa-ruler"></i> طول</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <p>From:</p>
                                            <div class="col-md-6 mb-3">
                                                <select class="form-select" id="length-from-unit">
                                                    <option value="mm">MM</option>
                                                    <option value="cm">CM</option>
                                                    <option value="inch">Inch</option>
                                                    <option value="foot">Foot</option>
                                                    <option value="meter">Meter</option>
                                                    <option value="km">KM</option>
                                                    <option value="mile">Mile</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input class="form-control" type="number" step="0.01" id="length-from-value">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p>To:</p>
                                            <div class="col-md-6 mb-3">
                                                <select class="form-select" id="length-to-unit">
                                                    <option value="mm">MM</option>
                                                    <option value="cm">CM</option>
                                                    <option value="inch">Inch</option>
                                                    <option value="foot">Foot</option>
                                                    <option value="meter">Meter</option>
                                                    <option value="km">KM</option>
                                                    <option value="mile">Mile</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input class="form-control" id="length-to-value" readonly>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" onclick="convertLength()"><i class="fas fa-sync"></i> Convert</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <div class="card">
                                    <h5 class="card-header"><i class="fas fa-weight-hanging"></i> وزن</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <p>From:</p>
                                            <div class="col-md-6 mb-3">
                                                <select class="form-select" id="weight-from-unit">
                                                    <option value="grain">Grain</option>
                                                    <option value="gram">Gram</option>
                                                    <option value="ounce">Ounce</option>
                                                    <option value="pound">Pound</option>
                                                    <option value="kg">KG</option>
                                                    <option value="stone">Stone</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input class="form-control" type="number" step="0.01" id="weight-from-value">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p>To:</p>
                                            <div class="col-md-6 mb-3">
                                                <select class="form-select" id="weight-to-unit">
                                                    <option value="grain">Grain</option>
                                                    <option value="gram">Gram</option>
                                                    <option value="ounce">Ounce</option>
                                                    <option value="pound">Pound</option>
                                                    <option value="kg">KG</option>
                                                    <option value="stone">Stone</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input class="form-control" id="weight-to-value" readonly>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" onclick="convertWeight()"><i class="fas fa-sync"></i> Convert</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <div class="card">
                                    <h5 class="card-header"><i class="fas fa-tachometer-alt"></i> سرعت</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <p>From:</p>
                                            <div class="col-md-6 mb-3">
                                                <select class="form-select" id="speed-from-unit">
                                                    <option value="fts">Ft/S</option>
                                                    <option value="ms">M/S</option>
                                                    <option value="kmh">KM/H</option>
                                                    <option value="mih">Mi/H</option>
                                                    <option value="knots">Knots</option>
                                                    <option value="lightspeed">Light Speed</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input class="form-control" type="number" step="0.01" id="speed-from-value">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p>To:</p>
                                            <div class="col-md-6 mb-3">
                                                <select class="form-select" id="speed-to-unit">
                                                    <option value="fts">Ft/S</option>
                                                    <option value="ms">M/S</option>
                                                    <option value="kmh">KM/H</option>
                                                    <option value="mih">Mi/H</option>
                                                    <option value="knots">Knots</option>
                                                    <option value="lightspeed">Light Speed</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input class="form-control" id="speed-to-value" readonly>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" onclick="convertSpeed()"><i class="fas fa-sync"></i> Convert</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-5">
                                <div class="card">
                                    <h5 class="card-header"><i class="fas fa-thermometer-half"></i> دما</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <p>From:</p>
                                            <div class="col-md-6 mb-3">
                                                <select class="form-select" id="temperature-from-unit">
                                                    <option value="centigrade">Centigrade</option>
                                                    <option value="fahrenheit">Fahrenheit</option>
                                                    <option value="kelvin">Kelvin</option>
                                                    <option value="rankine">Rankine</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input class="form-control" type="number" step="0.01" id="temperature-from-value">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p>To:</p>
                                            <div class="col-md-6 mb-3">
                                                <select class="form-select" id="temperature-to-unit">
                                                    <option value="centigrade">Centigrade</option>
                                                    <option value="fahrenheit">Fahrenheit</option>
                                                    <option value="kelvin">Kelvin</option>
                                                    <option value="rankine">Rankine</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input class="form-control" id="temperature-to-value" readonly>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" onclick="convertTemperature()"><i class="fas fa-sync"></i> Convert</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <div class="card">
                                    <h5 class="card-header"><i class="fas fa-database"></i> داده های دیجیتال </h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <p>From:</p>
                                            <div class="col-md-6 mb-3">
                                                <select class="form-select" id="storage-from-unit">
                                                    <option value="bit">Bit</option>
                                                    <option value="byte">Byte</option>
                                                    <option value="kib">KiB</option>
                                                    <option value="mib">MiB</option>
                                                    <option value="gib">GiB</option>
                                                    <option value="tib">TiB</option>
                                                    <option value="pib">PiB</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input class="form-control" type="number" step="0.01" id="storage-from-value">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p>To:</p>
                                            <div class="col-md-6 mb-3">
                                                <select class="form-select" id="storage-to-unit">
                                                    <option value="bit">Bit</option>
                                                    <option value="byte">Byte</option>
                                                    <option value="kib">KiB</option>
                                                    <option value="mib">MiB</option>
                                                    <option value="gib">GiB</option>
                                                    <option value="tib">TiB</option>
                                                    <option value="pib">PiB</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <input class="form-control" id="storage-to-value" readonly>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" onclick="convertStorage()"><i class="fas fa-sync"></i> Convert</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
@push('styles')


@endpush
@push('scripts')
<script type="text/javascript" src="{{asset('vendor/script.js')}}"></script>
@endpush
@endsection