@section('title','لیست مجوزها')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>لیست مجوزها</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">مجوزها</a></li>
                        <li class="breadcrumb-item active">لیست مجوزها</li>
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
            @if($is_edit)
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>ویرایش مجوز</strong></h2>
                            </div>
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label>نام نمایشی</label>
                                            <input type="text" name="display_name"
                                                   class="form-control @error('display_name') is-invalid @enderror"
                                                   wire:model="display_name">
                                            @error('display_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <div class="form-group">
                                            <label>عنوان مجوز</label>
                                            <input type="text" wire:model="name" disabled class="form-control">
                                        </div>
                                    </div>
                                    <div class="col m-auto">
                                        <button wire:click="updatePermission" wire:loading.attr="disabled"
                                                class="mt-md-3 btn btn-raised btn-warning waves-effect">
                                            ویرایش
                                            <span class="spinner-border spinner-border-sm text-light" wire:loading
                                                  wire:target="updatePermission"></span>
                                        </button>
                                        <button class="btn btn-raised btn-info waves-effect mt-md-3"
                                                wire:loading.attr="disabled" wire:click="ref">صرف نظر
                                            <span class="spinner-border spinner-border-sm text-light" wire:loading
                                                  wire:target="ref"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>لیست مجوزها</strong></h2>
                        </div>
                        @if(count($permissions)===0)
                            <p>هیچ رکوردی وجود ندارد</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover c_table theme-color">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>نام نمایشی</th>
                                        <th>نام</th>
                                        <th class="text-center">ویرایش</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($permissions as $key => $permission)
                                        <tr wire:key={{$key}}>
                                            <td scope="row">{{$permissions->firstItem() + $key}}</td>
                                            <td>{{$permission->display_name}}</td>
                                            <td>{{$permission->name}}</td>
                                            <td class="text-center">
                                                <button wire:click="editPermission({{$permission->id}})"
                                                        wire:loading.attr="disabled"
                                                        {{$display}} class="btn btn-raised btn-info waves-effect scroll">
                                                    <i class="zmdi zmdi-edit"></i>
                                                    <span class="spinner-border spinner-border-sm text-light"
                                                          wire:loading
                                                          wire:target="editPermission({{$permission->id}}) "></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div dir="ltr">
                        {{ $permissions->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
