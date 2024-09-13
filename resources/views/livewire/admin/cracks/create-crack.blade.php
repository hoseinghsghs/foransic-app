@section('title', 'لیست درخواست های لایسنس')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>مدیریت درخواست های لایسنس</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);"> آزمایشگاه </a></li>
                        <li class="breadcrumb-item active">مدیریت درخواست های لایسنس</li>
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
            <!-- add crack -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="form-group col-md-4 col-sm-6">
                                    <label>عنوان برنامه <abbr class="required" title="ضروری" style="color:red;">*</abbr></label>
                                    <input type="text" name="title" wire:model.defer="title" class="form-control">
                                    @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 col-sm-6">
                                    <label>نسخه برنامه <abbr class="required" title="ضروری" style="color:red;">*</abbr></label>
                                    <input type="text" name="program_version" wire:model.defer="program_version"
                                        class="form-control">
                                    @error('program_version')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 col-sm-6">
                                    <label>کد سخت افزاری <abbr class="required" title="ضروری"
                                            style="color:red;">*</abbr></label>
                                    <input type="text" name="hardware_code" wire:model.defer="hardware_code"
                                        class="form-control">
                                    @error('hardware_code')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div
                                    class="form-group col-md-6 @error('description_personal') is-invalid @enderror">
                                    <label> توضیحات پرسنل درخواست کننده <abbr class="required" title="ضروری"
                                            style="color:red;">*</abbr></label>
                                    <textarea class="form-control" rows="9"
                                        wire:model.defer="description_personal">{!! $description_personal !!}</textarea>
                                    @error('description_personal')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                @hasanyrole(['Super Admin'])
                                <div class="col-md-6 col-sm-6 form-group">
                                    <label>فایل کرک</label>
                                    <div wire:ignore>
                                        <input type="file" class="dropify" name="license_file" id="license_file"
                                            wire:model="license_file" data-max-file-size="40M"
                                            data-allowed-file-extensions="docx xlsx pdf csv zip rar">
                                    </div>
                                    <div class="progress" role="progressbar" aria-label="Animated striped example"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                        <div wire:loading wire:target="license_file"
                                            class="progress-bar progress-bar-striped progress-bar-animated"
                                            style="width: 100%"></div>
                                    </div>
                                    @if ($is_edit && $crack->license_file)
                                    لینک دانلود :
                                    <a href={{ url('storage/license_files/' . $crack->license_file) }}>{{ $crack->license_file }}</a>
                                    @endif
                                </div>


                                <div class="form-group col-md-12 @error('description_admin') is-invalid @enderror">
                                    <label> توضیحات مدیریت <abbr class="required" title="ضروری"
                                            style="color:red;">*</abbr></label>
                                    <div>
                                        <textarea class="form-control" rows="4"
                                            wire:model.defer="description_admin">{!! $description_admin !!}</textarea>
                                    </div>
                                    @error('description_admin')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @else
                                @if ($description_admin )
                                <div class="form-group col-md-6">
                                    <label> توضیحات مدیریت </label>
                                    <textarea class="form-control" rows="9"
                                        disabled>{!! $description_admin !!}</textarea>
                                </div>
                                @endif
                                @if ($is_edit && $crack->license_file)
                                <div class="form-group col-auto">
                                    <label> لینک دانلود فایل کرک :</label>
                                    <div>
                                        <a href={{ url('storage/license_files/' . $crack->license_file) }}>{{ $crack->license_file }}</a>
                                    </div>
                                </div>
                                @endif
                                @endhasanyrole

                                <div class=" col-12">
                                    @if ($is_edit && (auth()->user()->hasRole('Super Admin') || !$crack->license_file))
                                    <button wire:click="add_crack" wire:loading.attr="disabled"
                                        class="btn btn-raised btn-warning waves-effect">
                                        ویرایش
                                        <span class="spinner-border spinner-border-sm text-light" wire:loading
                                            wire:target="add_crack"></span>
                                    </button>
                                    @elseif(!$is_edit)
                                    <button wire:click="add_crack" wire:loading.attr="disabled"
                                        class="btn btn-raised btn-primary waves-effect">
                                        افزودن
                                        <span class="spinner-border spinner-border-sm text-light" wire:loading
                                            wire:target="add_crack"></span>
                                    </button>
                                    @endif

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
                            <h2 style="display: inline;"><strong>لیست درخواست های لایسنس </strong>
                                ({{ $cracks->total() }})
                            </h2>
                            @can('cracks-export')
                            <a style="float: left" onclick="loadbtn(event)" href="{{ route('admin.file-cracks') }}"
                                class="btn btn-raised btn-warning waves-effect ml-4 ">
                                خروجی درخواست های لایسنس <i class="zmdi zmdi-developer-board mr-1"></i></a>
                            @endcan
                        </div>

                        @hasanyrole(['Super Admin','viewer'])
                        <div class="header">
                            <h2>
                                جست و جو
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                wire:model.live="title"
                                                placeholder="عنوان">
                                        </div>
                                    </div>
                                </div>
                                @php($laboratories=\App\Models\Laboratory::all())
                                <div class="form-group col-md-4 col-sm-4 @error('laboratory_id') is-invalid @enderror">
                                    <div wire:ignore>
                                        <select id="laboratorySelect" name="laboratory_id" wire:model.live="laboratory_id_search"
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
                                    @error('laboratory_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endhasanyrole

                        <div class="body">
                            @if (count($cracks) === 0)
                            <p>هیچ رکوردی وجود ندارد</p>
                            @else
                            <div class="table-responsive">
                                <table class="table table-hover c_table theme-color">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>عنوان</th>
                                            <th>نسخه</th>
                                            <th>کد سخت افزاری</th>
                                            <th>آزمایشگاه</th>
                                            <th>لینک فایل کرک</th>
                                            <th>درخواست کننده</th>
                                            <th>تاریخ ثبت درخواست</th>
                                            <th>تاریخ پاسخ به درخواست</th>
                                            <th class="text-center js-sweetalert">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cracks as $crack)
                                        <tr wire:key="{{ $crack->id }}" wire:loading.attr="disabled">
                                            <td scope="row">{{ $loop->index + 1 }}</td>
                                            <td>{{ $crack->title }}</td>
                                            <td>{{ $crack->program_version }}</td>
                                            <td>{{ $crack->hardware_code }}</td>
                                            <td>{{ $crack->laboratory ? $crack->laboratory->name :'ندارد'}}</td>
                                            <td>
                                                @isset($crack->license_file)
                                                <a href={{ url('storage/license_files/' . $crack->license_file) }}>{{ $crack->license_file }}</a>
                                                @endisset
                                            </td>
                                            <td>{{ $crack->user->name }}</td>
                                            <td>{{ verta($crack->created_at)->format('Y-n-j H:i')}}</td>
                                            <td>{{ verta($crack->updated_at)->format('Y-n-j H:i')}}</td>
                                            <td class="text-center js-sweetalert">
                                                <button wire:click="edit_crack({{ $crack->id }})"
                                                    wire:loading.attr="disabled"
                                                    {{ $display }} class="btn btn-raised btn-info waves-effect scroll">
                                                    <i class="zmdi zmdi-edit"></i>
                                                    <span class="spinner-border spinner-border-sm text-light"
                                                        wire:loading
                                                        wire:target="edit_crack({{ $crack->id }}) "></span>
                                                </button>

                                                {{-- <button class="btn btn-raised btn-danger waves-effect"
                                                                wire:loading.attr="disabled"
                                                                wire:click="del_crack({{ $crack->id }})"
                                                wire:confirm="از حذف رکورد مورد نظر اطمینان دارید؟"
                                                {{ $display }}>
                                                <i class="zmdi zmdi-delete"></i>
                                                <span class="spinner-border spinner-border-sm text-light" wire:loading wire:target="del_crack({{ $crack->id }})"></span>
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

                        {{ $cracks->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
<script>
    $('.dropify').dropify({
        messages: {
            default: "   فایل را در اینجا بکشید یا رها کنید یا کلیک کنید",
            replace: "برای جایگزینی کشیدن و رها کردن یا کلیک کنید",
            remove: "حذف",
            error: "اوه، چیزی اشتباه اضافه شده.",
        },
    });
    Livewire.on('resetfile', () => {
        var drEvent = $('.dropify').dropify();
        drEvent = drEvent.data('dropify');
        drEvent.resetPreview();
        drEvent.clearElement();
    });

    $('.scroll').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
    $('#laboratorySelect').on('change', function(e) {
        let data = $('#laboratorySelect').select2("val");
        if (data === '') {
            @this.set('laboratory_id_search', null);
        } else {
            @this.set('laboratory_id_search', data);
        }
    });
</script>

@endpush