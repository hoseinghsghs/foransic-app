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
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" wire:model.live.debounce.500ms="title"
                                        placeholder="نام شواهد دیجیتال، کد">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <select data-placeholder="وضعیت" wire:model.live="is_active"
                                        class="form-control ms">
                                        <option value="">وضعیت</option>
                                        <option value="1">فعال</option>
                                        <option value="0">غیرفعال</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <select data-placeholder="موجودی" wire:model.live="status" class="form-control ms">
                                        <option value="">وضعیت بررسی</option>
                                        <option value="0">پذیرش شواهد دیجیتال</option>
                                        <option value="1">در حال بررسی</option>
                                        <option value="2"> تکمیل تجزیه و تحلیل
                                        </option>
                                        <option value="3">تحویل شواهد دیجیتال</option>
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
                    <a onclick="loadbtn(event)" href="{{ route('admin.devices.create') }}"
                        class="btn btn-raised btn-info waves-effect mr-auto">
                        افزودن<i class="zmdi zmdi-plus mr-1"></i></a>

                    <a onclick="loadbtn(event)" href="{{ route('admin.file-device') }}"
                        class="btn btn-raised btn-warning waves-effect ">
                        خروجی شواهد دیجیتال<i class="zmdi zmdi-developer-board mr-1"></i></a>

                    {{-- <a onclick="window.open('{{ route('admin.file-device2') }}');"
                        href="{{ route('admin.file-device') }}" class="btn btn-raised btn-warning waves-effect ">
                        خروجی اکسل<i class="zmdi zmdi-developer-board mr-1"></i></a> --}}
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
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>کد</th>
                                    <th>شخص تحویل دهنده</th>
                                    <th>پرسنل تحویل گیرنده</th>
                                    <th>شخص تحویل گیرنده</th>
                                    <th>پرسنل تحویل دهنده</th>
                                    <th> تاریخ دریافت</th>
                                    <th> تاریخ تحویل</th>
                                    <th>وضعیت</th>
                                    <th>بایگانی</th>
                                    <th class="text-center">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($devices as $key => $device)
                                    <tr wire:key="name_{{ $loop->index + 1 }}">
                                        <td scope="row">{{ $key + 1 }}</td>
                                        <td>
                                            {{ $device->category->title }}
                                        </td>
                                        <td>
                                            {{ $device->code }}
                                        </td>
                                        <td>
                                            {{ $device->delivery_name }}
                                        </td>
                                        <td>
                                            @if ($device->receiver_staff_id)
                                                {{ App\Models\User::find($device->receiver_staff_id)->name }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $device->receiver_name }}
                                        </td>

                                        <td>
                                            @if ($device->delivery_staff_id)
                                                {{ App\Models\User::find($device->delivery_staff_id)->name }}
                                            @endif
                                        </td>


                                        <td dir="ltr">
                                            {{ $device->receiver_date }}
                                        </td>
                                        <td dir="ltr">
                                            {{ $device->delivery_date }}
                                        </td>
                                        <td>
                                            <button wire:click="ChangeActive_device({{ $device->id }})"
                                                wire:loading.attr="disabled" @class([
                                                    'btn btn-raised waves-effect',
                                                    'btn-success' => $device->is_active,
                                                    'btn-danger' => !$device->is_active,
                                                ])>
                                                {{ $device->is_active ? 'فعال' : 'غیرفعال' }}
                                            </button>
                                        </td>
                                        <td>
                                            <button wire:click="ChangeArchive_device({{ $device->id }})"
                                                wire:loading.attr="disabled"
                                                class="btn btn-raised btn-danger waves-effect">بایگانی کردن
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            {{-- <a onclick="loadbtn(event)"
                                                href="{{ route('admin.devices.edit', $device->id) }}"
                                                class="btn btn-raised btn-warning waves-effect">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a> --}}
                                            <a onclick="loadbtn(event)" title="اضافه کردن اقدام" data-toggle="tooltip"
                                                data-placement="top"
                                                href="{{ route('admin.actions.create', ['device' => $device->id]) }}"
                                                class="btn btn-raised btn-info waves-effect">

                                                ایجاد اقدام

                                            </a>
                                            <div class="btn-group">
                                                <button type="button"
                                                    class="btn btn-md btn-warning btn-outline-primary dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    ویرایش
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a href="{{ route('admin.devices.edit', ['device' => $device->id]) }}"
                                                        class="dropdown-item text-right"> ویرایش </a>
                                                    <a href="{{ route('admin.devices.images.edit', ['device' => $device->id]) }}"
                                                        class="dropdown-item text-right"> ویرایش تصویر </a>
                                                    <a href="{{ route('admin.devices.show', $device->id) }}"
                                                        class="dropdown-item text-right"> مشاهده </a>
                                                    <a href="{{ route('admin.print.device.show', $device->id) }}"
                                                        class="dropdown-item text-right" target="_blank"> پرینت رسید
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <div dir="ltr">
            {{ $devices->onEachSide(1)->links() }}
        </div>
    </div>
</div>
