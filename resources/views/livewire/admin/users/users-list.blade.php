<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <div class="row clearfix mt-1 align-items-center">
                    <div class="col-md-auto"><label>جستجو :</label></div>
                    <div class="form-group col-md-4 @error('search') is-invalid @enderror">
                    <div class="inner-addon left-addon">
                        <i class="zmdi zmdi-hc-fw input-icon" wire:target="search" wire:loading.remove></i>
                        <i class="zmdi zmdi-hc-fw zmdi-hc-spin input-icon" wire:loading wire:target="search"></i>
                        <input type="text" name="search"
                               class="form-control @error('search') is-invalid @enderror"
                               wire:model.live.debounce.500ms="search" placeholder=" نام، نام کاربری، تلفن">
                    </div>
                    @error('search')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-4 @error('role') is-invalid @enderror">
                    <div wire:ignore>
                        <select id="roleSelect" name="role" data-placeholder="انتخاب نقش"
                                class="form-control ms select2">
                            <option value=''>انتخاب نقش</option>
                            <option value='false'>بدون نقش</option>
                            @foreach($roles as $role)
                                <option value="{{$role->name}}">{{$role->display_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('role')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-auto">
                    <div class="form-group">
                        <a onclick="loadbtn(event)" href="{{ route('admin.file-users') }}"
                           class="btn btn-raised btn-warning waves-effect ">
                            خروجی کاربران<i class="zmdi zmdi-developer-board mr-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover footable c_table theme-color">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>نام کاربری</th>
                    <th>شماره تلفن</th>
                    <th>نقش</th>
                    @if(auth()->user()->hasRole('Super Admin'))
                    <th>آزمایشگاه</th>
                    @endif
                    <th>تاریخ ایجاد حساب</th>
                    <th class="text-center">عملیات</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($users as $key => $user)
                    <tr>
                        <td scope="row">{{ $users->firstItem() + $key }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->cellphone }}</td>
                        <td>{{ $user->roles()->exists()?$user->roles()->pluck('display_name')->first():'-' }}</td>
                        @if(auth()->user()->hasRole('Super Admin'))
                        <td>{{$user->laboratory()->exists()? $user->laboratory->name :'-'}}</td>
                        @endif
                        <td>{{ verta($user->created_at)->format('H:i Y/n/j') }}</td>
                        <td class="text-center js-sweetalert">
                            <a onclick="loadbtn(event)" href="{{ route('admin.users.show', $user->id) }}"
                               class="btn btn-light waves-effect waves-float btn-sm waves-green">
                                <i class="zmdi zmdi-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="btn btn-light waves-effect waves-float btn-sm waves-green"
                               onclick="loadbtn(event)">
                                <i class="zmdi zmdi-edit"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <p class="text-center text-muted">هیچ رکوردی یافت نشد!</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{ $users->onEachSide(1)->links() }}
</div>
@push('scripts')
    <script>
        $('#roleSelect').on('change', function (e) {
            let data = $('#roleSelect').select2("val");
        @this.set('role', data);
        });
    </script>
@endpush
