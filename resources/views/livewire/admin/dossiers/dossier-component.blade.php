@section('title', 'لیست پرونده ها')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>لیست پرونده ها</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item active">لیست پرونده ها</li>
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
                                                <input type="text" class="form-control"
                                                       wire:model.live.debounce.500ms="title"
                                                       placeholder="نام پرونده، کد">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control ms" wire:model.live="company_user">
                                                    <option value="">نام رده</option>
                                                    @foreach ($company_users as $company_user)
                                                        <option value="{{ $company_user->id }}">
                                                            {{ $company_user->cellphone }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
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
                                </div>
                            </div>
                        </form>
                        <div class="header d-flex align-items-center">
                            {{-- <h2><strong>لیست پرونده </strong> ( {{ $dossier }} )</h2> --}}
                            <div class="mr-auto">
                                @can('dossiers-create')
                                    <a onclick="loadbtn(event)" href="{{ route('admin.dossiers.create') }}"
                                       class="btn btn-raised btn-info waves-effect mr-auto">
                                        افزودن<i class="zmdi zmdi-plus mr-1"></i></a>
                                @endcan
                                @can('dossiers-export')
                                    <a onclick="loadbtn(event)" href="{{ route('admin.file-dossier') }}"
                                       class="btn btn-raised btn-warning waves-effect ">
                                        خروجی اکسل پرونده ها<i class="zmdi zmdi-developer-board mr-1"></i></a>
                                @endcan
                            </div>
                        </div>
                        <div class="body">
                            <div class="loader" wire:loading.flex>
                                درحال بارگذاری ...
                            </div>

                            @if (count($dossiers) === 0)
                                <p>هیچ رکوردی وجود ندارد</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover c_table theme-color">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نام پرونده یا کیس</th>
                                            <th>موضوع</th>
                                            <th>شماره پرونده</th>
                                            <th>مدیریت یا معاونت</th>
                                            <th> رده</th>
                                            <th>پرسنل آزمایشگاه مربوطه</th>
                                            <th> تاریخ ایجاد</th>
                                            <th>وضعیت</th>
                                            <th>بایگانی</th>
                                            <th class="text-center">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($dossiers as $key => $dossier)
                                            <tr wire:key="name_{{ $dossier->id }}">
                                                <td scope="row">{{ $key + 1 }}</td>
                                                <td>
                                                    {{ $dossier->name }}
                                                </td>
                                                <td>
                                                    {{ $dossier->subject }}
                                                </td>
                                                <td>
                                                    {{ $dossier->number_dossier }}
                                                </td>
                                                <td>
                                                    {{ $dossier->section }}
                                                </td>
                                                <td dir="ltr">
                                                    {{ App\Models\User::find($dossier->user_category_id)->name }}
                                                </td>
                                                <td dir="ltr">
                                                    {{ App\Models\User::find($dossier->personal_creator_id)->name }}
                                                </td>
                                                <td dir="ltr">
                                                    {{ verta($dossier->created_at)->format('Y/n/j') }}
                                                </td>
                                                <td>
                                                    <button wire:click="ChangeActive_dossier({{ $dossier->id }})"
                                                            wire:loading.attr="disabled" @class([
                                                                'btn btn-raised waves-effect',
                                                                'btn-success' => $dossier->is_active,
                                                                'btn-danger' => !$dossier->is_active,
                                                            ])>
                                                        {{ $dossier->is_active ? 'فعال' : 'غیرفعال' }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <button wire:click="ChangeArchive_dossier({{ $dossier->id }})"
                                                            wire:loading.attr="disabled"
                                                            class="btn btn-raised btn-danger waves-effect">بایگانی کردن
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    {{-- <a onclick="loadbtn(event)"
                                                    href="{{ route('admin.dossiers.edit', $dossier->id) }}"
                                                    class="btn btn-raised btn-warning waves-effect">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a> --}}
                                                    {{-- <a onclick="loadbtn(event)"
                                                    href="{{ route('admin.actions.create', ['dossier' => $dossier->id]) }}"
                                                    class="btn btn-raised btn-info waves-effect">
                                                    <i class="zmdi zmdi-file-plus" style="font-size: 1.2rem"></i>
                                                </a> --}}
                                                    <div class="btn-group">
                                                        <button type="button"
                                                                class="btn btn-md btn-warning btn-outline-primary dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <i class="zmdi zmdi-edit" style="font-size: 1.2rem"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a href="{{ route('admin.dossiers.edit', ['dossier' => $dossier->id]) }}"
                                                               class="dropdown-item text-right"> ویرایش </a>
                                                            <a href="{{ route('admin.dossiers.show', $dossier->id) }}"
                                                               class="dropdown-item text-right"> مشاهده </a>
                                                            {{-- <a href="{{ route('admin.print.dossier.show', $dossier->id) }}"
                                                            class="dropdown-item text-right" target="_blank"> پرینت رسید
                                                        </a> --}}
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
                        {{ $dossiers->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
