@section('title', 'لیست شواهد دیجیتال بایگانی')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>لیست شواهد دیجیتال بایگانی</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item active">لیست شواهد دیجیتال بایگانی شده</li>
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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <form wire:submit.prevent="$refresh">
                            <div class="header">
                                <h2>
                                    جست و جو
                                </h2>
                            </div>
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" wire:model.live.debounce.500ms="ids" placeholder="کد یکتا">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" wire:model.live.debounce.500ms="title" placeholder="نام شواهد دیجیتال، کد">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select data-placeholder="وضعیت" wire:model.live="is_active" class="form-control ms">
                                                    <option value="">وضعیت</option>
                                                    <option value="1">فعال</option>
                                                    <option value="0">غیرفعال</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @hasanyrole(['Super Admin','viewer'])
                                  @php($laboratories=\App\Models\Laboratory::all())
                                    <div class="form-group col-md-3 col-sm-3 @error('laboratory_id') is-invalid @enderror">
                                        <div wire:ignore>
                                            <select id="laboratorySelect" wire:model.live="laboratory_id_search"
                                                data-placeholder="انتخاب آزمایشگاه"
                                                class="form-control ms search-select">
                                                <option></option>
                                                @foreach ($laboratories as $laboratory)
                                                <option value={{ $laboratory->id }}>
                                                    {{ $laboratory->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                   @php($dossiers=\App\Models\Dossier::all())
                                    <div class="form-group col-md-3 col-sm-3 @error('dossier_id') is-invalid @enderror">
                                        <div wire:ignore>
                                            <select id="dossierSelect" wire:model.live="dossier_id_search"
                                                data-placeholder="انتخاب پرونده"
                                                class="form-control ms search-select">
                                                <option></option>
                                                @foreach ($dossiers as $dossier)
                                                <option value={{ $dossier->id }}>
                                                    {{ $dossier->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                     @endhasanyrole
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select data-placeholder="موجودی" wire:model.live="status" class="form-control ms">
                                                    <option value="">وضعیت بررسی</option>
                                                    <option value="0">پذیرش شواهد دیجیتال</option>
                                                    <option value="1">در حال بررسی</option>
                                                    <option value="2"> تکمیل تجزیه و تحلیل
                                                    </option>
                                                    <option value="3">خروج شواهد دیجیتال</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="header d-flex align-items-center">
                            <h2><strong>لیست شواهد دیجیتال </strong> ( {{ $devices->total() }} )</h2>
                            <div class="mr-auto">
                                @can('devices-create')
                                <a onclick="loadbtn(event)" href="{{ route('admin.devices.create') }}" class="btn btn-raised btn-info waves-effect mr-auto">
                                    افزودن<i class="zmdi zmdi-plus mr-1"></i></a>
                                {{-- <a onclick="window.open('{{ route('admin.file-device2') }}');"
                                href="{{ route('admin.file-device') }}" class="btn btn-raised btn-warning waves-effect ">
                                خروجی اکسل<i class="zmdi zmdi-developer-board mr-1"></i></a> --}}
                                @endcan
                            </div>
                        </div>
                        <div class="body">
                            <div class="loader" wire:loading.flex>
                                درحال بارگذاری ...
                            </div>
                            @if (count($devices) === 0)
                            <p>هیچ رکوردی وجود ندارد</p>
                            @else
                            <div class="table-responsive">
                                <table class="table table-hover c_table theme-color">
                                    <thead>
                                        <tr>
                                            <th>
                                            </th>
                                            <th>ردیف</th>
                                            <th>کد یکتا</th>
                                            <th>عنوان</th>
                                            <th>مدل</th>
                                            @hasanyrole(['Super Admin','company','viewer'])
                                            <th>آزمایشگاه</th>
                                            @endhasanyrole
                                            <th> تاریخ پذیرش</th>
                                            <th>پرونده</th>
                                            <th>وضعیت بررسی</th>
                                            <th>پرسنل تحویل گیرنده</th>
                                            <th>ارتباط</th>
                                            <th>وضعیت</th>
                                            <th>بایگانی</th>
                                            <th class="text-center">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($devices as $key => $device)
                                        <tr wire:key="name_{{ $device->id }}">
                                            @canany(['devices-edit','device-image-edit','devices-show','device-print'])
                                            <td scope="row">
                                                @can('devices-edit')
                                                <a href="{{ route('admin.devices.edit', ['device' => $device->id]) }}" class="btn btn-warning btn-sm text-right"> <i class="zmdi zmdi-edit"></i></a>
                                                @endcan
                                                @can('devices-show')
                                                <a href="{{ route('admin.devices.show', $device->id) }}" class="btn btn-primary btn-sm  text-right"> <i class="zmdi zmdi-eye"></i></a>
                                                @endcan
                                                @if ($device->correspondence_number)
                                                <i class="zmdi zmdi-email btn btn-success btn-sm"></i>
                                                @else
                                                <i class="zmdi zmdi-hourglass-alt btn btn-sm"></i>
                                                @endif
                                            </td>
                                            @endcanany
                                            <td scope="row">{{ $devices->firstItem() + $key }}</td>
                                            <td>
                                                {{ $device->id }}
                                            </td>
                                            <td>
                                                {{ $device->category->title }}
                                            </td>
                                            <td>
                                                {{ $device->code }}
                                            </td>

                                            @hasanyrole(['Super Admin','company','viewer'])
                                            <td>{{$device->laboratory()->exists()? $device->laboratory->name :'-'}}</td>
                                            @endhasanyrole
                                            <td dir="ltr">
                                                {{ $device->receive_date }}
                                            </td>
                                            <td>
                                                {{ $device->dossier->name }}
                                            </td>


                                            <td>
                                                @switch($device->status)
                                                @case('0')
                                                <span class="badge badge-danger badge-pill" style="font-size: 0.75rem;padding-right: 14px;
                                            padding-left: 14px;
                                            padding-bottom: 7px;">
                                                    پذیرش شواهد دیجیتال
                                                </span>
                                                @break

                                                @case('1')
                                                <span class="badge badge-warning badge-pill" style="font-size: 0.75rem;padding-right: 14px;
                                            padding-left: 14px;
                                            padding-bottom: 7px;">
                                                    در حال بررسی
                                                </span>
                                                @break

                                                @case('2')
                                                <span class="badge badge-success badge-pill" style="font-size: 0.75rem;padding-right: 14px;
                                            padding-left: 14px;
                                            padding-bottom: 7px;">
                                                    تکمیل تجزیه و تحلیل
                                                </span>
                                                @break
                                                @case('3')
                                                <span class="badge badge-primary badge-pill" style="font-size: 0.75rem;padding-right: 14px;
    padding-left: 14px;
    padding-bottom: 7px;">
                                                    خروج شواهد دیجیتال
                                                </span>
                                                @endswitch
                                            </td>

                                            <td>
                                                @if ($device->receiver_staff_id)
                                                {{ App\Models\User::find($device->receiver_staff_id)->name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($device->parent_id)
                                                <button type="button" class="btn bg-warning waves-effect"
                                                    data-toggle="modal"
                                                    data-target="#defaultModal-{{ $key }}"> فرعی
                                                </button>
                                                @else
                                                <button type="button" class="btn bg-teal waves-effect"
                                                    data-toggle="modal"
                                                    data-target="#defaultModal-{{ $key }}"> اصلی
                                                </button>
                                                @endif


                                            </td>
                                            <td>
                                                <button wire:click="ChangeActive_device({{ $device->id }})" wire:loading.attr="disabled" @class([ 'btn btn-raised waves-effect' , 'btn-success'=> $device->is_active,
                                                    'btn-danger' => !$device->is_active,
                                                    ])>
                                                    {{ $device->is_active ? 'فعال' : 'غیرفعال' }}
                                                </button>
                                            </td>
                                            <td>
                                                <button wire:click="ChangeArchive_device({{ $device->id }})" wire:loading.attr="disabled" class="btn btn-raised btn-danger waves-effect">خروج از بایگانی
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                {{-- <a onclick="loadbtn(event)"
                                                        href="{{ route('admin.devices.edit', $device->id) }}"
                                                class="btn btn-raised btn-warning waves-effect">
                                                <i class="zmdi zmdi-edit"></i>
                                                </a> --}}
                                                @can('actions-create')
                                                <a onclick="loadbtn(event)" title="اضافه کردن اقدام" data-toggle="tooltip" data-placement="top" href="{{ route('admin.actions.create', ['device' => $device->id]) }}" class="btn btn-raised btn-info waves-effect">
                                                    ایجاد اقدام
                                                </a>
                                                @endcan
                                                @canany(['devices-edit','device-image-edit','devices-show','device-print'])
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-md btn-warning btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="zmdi zmdi-menu"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @can('devices-edit')
                                                        <a href="{{ route('admin.devices.edit', ['device' => $device->id]) }}" class="dropdown-item text-right"> ویرایش </a>
                                                        @endcan
                                                        @can('device-image-edit')
                                                        <a href="{{ route('admin.devices.images.edit', ['device' => $device->id]) }}" class="dropdown-item text-right"> ویرایش
                                                            تصویر </a>
                                                        @endcan
                                                        @can('devices-show')
                                                        <a href="{{ route('admin.devices.show', $device->id) }}" class="dropdown-item text-right"> مشاهده </a>
                                                        @endcan
                                                        @can('device-print')
                                                        <a href="{{ route('admin.print.device.show', $device->id) }}" class="dropdown-item text-right" target="_blank">
                                                            پرینت
                                                            رسید
                                                        </a>
                                                        @endcan
                                                    </div>
                                                </div>
                                                @endcanany
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="defaultModal-{{ $key }}"
                                            tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="header p-0">
                                                            <strong style="color:#e47297"> شواهد مرتبط (شاهد سبز رنگ شاهد فعلی در حال مشاهده است) </strong>
                                                        </div>
                                                        <hr>
                                                        <div class="row clearfix">

                                                            @if ($device->parent_id != 0)

                                                            <div class="col-lg-12 col-md-12" style=" text-align: center;">
                                                                <?php
                                                                $rel_1 = app\Models\Device::find($device->parent_id);
                                                                $rels_2 = app\Models\Device::where('parent_id', $rel_1->id)->get();
                                                                ?>
                                                                <a class="btn bt-sm" href="{{ route('admin.devices.show', $rel_1->id) }}">
                                                                    {{$rel_1->category->title}}-
                                                                    {{$rel_1->code}}
                                                                </a>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12" style="text-align: -webkit-center">
                                                                <div class="col-lg-10 col-md-10" width="80%" style=" align-self: center; border-bottom: gray solid 2px;">
                                                                </div>
                                                            </div>
                                                            @foreach ( $rels_2 as $rel )
                                                            @if ($rel->id == $device->id)

                                                            <div class=" col " style=" text-align: center; ">
                                                                <a class=" btn bt-sm btn-success" href="{{ route('admin.devices.show', $rel->id) }}">
                                                                    @if ($rel)
                                                                    {{$rel->category->title}}-
                                                                    {{$rel->id}}-
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            @else
                                                            <div class="col" style=" text-align: center;">
                                                                <a class="btn bt-sm " href="{{ route('admin.devices.show', $rel->id) }}">
                                                                    @if ($rel)
                                                                    {{$rel->category->title}}-
                                                                    {{$rel->id}}
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            @endif

                                                            @endforeach
                                                            @else
                                                            <div class="col-lg-12 col-md-12" style=" text-align: center;">
                                                                <button class="btn bt-sm btn-success">
                                                                    {{$device->category->title }} - {{$device->code}}
                                                                </button>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12" style="text-align: -webkit-center">
                                                                <div class="col-lg-10 col-md-10" width="80%" style=" align-self: center; border-bottom: gray solid 2px;">
                                                                </div>
                                                            </div>
                                                            <?php
                                                            $rels = app\Models\Device::where('parent_id', $device->id)->get();
                                                            ?>
                                                            @foreach ( $rels as $rel )
                                                            <div class="col" style=" text-align: center;">
                                                                <a class="btn bt-sm " href="{{ route('admin.devices.show', $rel->id) }}">
                                                                    @if ($rel)
                                                                    {{$rel->category->title}}-
                                                                    {{$rel->id}}
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-danger waves-effect"
                                                            data-dismiss="modal">بستن
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                    {{ $devices->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
  <script>
            $('#laboratorySelect').on('change', function(e) {
        let data = $('#laboratorySelect').select2("val");
        if (data === '') {
            @this.set('laboratory_id_search', null);
        } else {
            @this.set('laboratory_id_search', data);
        }});
         $('#dossierSelect').on('change', function(e) {
        let data = $('#dossierSelect').select2("val");
        if (data === '') {
            @this.set('dossier_id_search', null);
        } else {
            @this.set('dossier_id_search', data);
        }});
</script>
@endpush

