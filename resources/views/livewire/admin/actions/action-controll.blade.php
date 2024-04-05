@section('title', 'ایجاد اقدام')
<section class="content">
    <div class="body_scroll">
    </div>
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>اضافه کردن اقدام</h2>
                </br>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                            خانه</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">اقدامات</a></li>
                    <li class="breadcrumb-item active">اقدام جدید</li>
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
    <div>
        <!-- Hover Rows -->
        <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix">

                                <div class="form-group col-md-12 col-sm-12 @error('description') is-invalid @enderror">
                                    <label for="">توضیحات اقدام *</label>
                                    <div>
                                        @if ($is_edit)
                                            <textarea class="form-control" wire:model.defer="description">{!! $action->description !!}</textarea>
                                        @else
                                            <textarea class="form-control" wire:model.defer="description">
                                        </textarea>
                                        @endif
                                    </div>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label> تاریخ و زمان شروع</label>
                                    <div class="form-group">
                                        <input type="text" wire:model.defer="start_date" id="start_date"
                                            class="form-control @error('start_date') is-invalid @enderror" required />
                                        <span id="start_date-display" class="text-warning"></span>
                                        @error('start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>تاریخ و زمان پایان</label>
                                    <div class="form-group">
                                        <input type="text" wire:model.defer="end_date" id="end_date"
                                            class="form-control @error('end_date') is-invalid @enderror" required />
                                        <span id="end_date-display" class="text-warning"></span>
                                        @error('end_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <label>وضعیت</label>
                                        <div class="form-line">
                                            <select data-placeholder="وضعیت" wire:model.live="status"
                                                class="form-control ms">
                                                <option value="">وضعیت</option>
                                                <option value="1">فعال</option>
                                                <option value="0">غیرفعال</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <label>نمایش در گزارش و پرینت</label>
                                        <div class="form-line">
                                            <select data-placeholder="وضعیت" wire:model.live="is_print"
                                                class="form-control ms">
                                                <option value="">وضعیت</option>
                                                <option value="1">فعال</option>
                                                <option value="0">غیرفعال</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <button wire:click="addAction" wire:loading.attr="disabled"
                                        class="btn btn-raised {{ $is_edit ? 'btn-warning' : 'btn-primary' }}  waves-effect">
                                        {{ $is_edit ? 'ویرایش' : 'افزودن' }}
                                        <span class="spinner-border spinner-border-sm text-light" wire:loading
                                            wire:target="addAction"></span>
                                    </button>
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
                            <h2><strong>لیست اقدامات </strong>( {{ $actions->total() }} )</h2>
                        </div>
                        <div class="body">

                            @if (count($actions) === 0)
                                <p>هیچ رکوردی وجود ندارد</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover c_table theme-color">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>نام پرسنل</th>
                                                <th>تاریخ و زمان شروع</th>
                                                <th>تاریخ و زمان پایان</th>
                                                <th>نمایش در گزارش</th>
                                                <th class="text-center js-sweetalert">عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($actions as $action)
                                                <tr wire:key="{{ $action->description }} {{ $action->id }}"
                                                    wire:loading.attr="disabled">
                                                    <td scope="row">{{ $action->id }}</td>
                                                    <td scope="row">{{ $action->user->name }} -
                                                        {{ $action->user->cellphone }}</td>
                                                    <td>{{ $action->start_date }}</td>
                                                    <td>{{ $action->end_date }}</td>
                                                    <td>
                                                        @if ($action->is_print)
                                                            <sapn class='text-success'> فعال </span>
                                                            @else
                                                                <sapn class='text-danger'>غیر فعال </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center js-sweetalert">

                                                        <button wire:click="edit_action({{ $action->id }})"
                                                            wire:loading.attr="disabled" {{ $display }}
                                                            class="btn btn-raised btn-info waves-effect scroll">
                                                            <i class="zmdi zmdi-edit"></i>
                                                            <span class="spinner-border spinner-border-sm text-light"
                                                                wire:loading
                                                                wire:target="edit_action({{ $action->id }}) "></span>
                                                        </button>

                                                        <button class="btn btn-raised btn-danger waves-effect"
                                                            wire:loading.attr="disabled"
                                                            wire:click="del_action({{ $action->id }})"
                                                            {{ $display }}>
                                                            <i class="zmdi zmdi-delete"></i>

                                                            <span class="spinner-border spinner-border-sm text-light"
                                                                wire:loading
                                                                wire:target="del_action({{ $action->id }})"></span>
                                                        </button>

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
        </div>
    </div>
</section>

@push('scripts')
    <script>
        $('.scroll').click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    </script>


    <script type="text/javascript">
        $(function() {
            $('#datetimepicker11').datetimepicker({
                daysOfWeekDisabled: [0, 6]
            });
        });
    </script>
@endpush
