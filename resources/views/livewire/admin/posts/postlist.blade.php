<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                @if (count($posts) === 0)
                    <p>هیچ رکوردی وجود ندارد</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover c_table theme-color">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>تصویر</th>
                                    <th>عنوان</th>
                                    <th>تاریخ</th>
                                    <th>نوشته شده توسط</th>
                                    <th>وضعیت</th>
                                    <th class="text-center">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $key => $post)
                                    <tr>
                                        <td scope="row">{{ $posts->firstItem() + $key }}</td>
                                        <td><a href="{{ asset('storage/' . $post->image->url) }}"
                                                data-lightbox="{{ 'post-' . $post->id }}"
                                                data-title="{{ $post->title }}"><img class="rounded avatar"
                                                    src="{{ asset('storage/' . $post->image->url) }}" width="55"
                                                    alt="{{ $post->title }}"></a></td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ Hekmatinasser\Verta\Verta::instance($post->created_at)->format('Y/n/j') }}
                                        </td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>
                                            <div class="col-6">
                                                @if ($post->status)
                                                    <a wire:click="Inactive_post({{ $post->id }})"
                                                        class="btn btn-raised btn-success waves-effect"><span
                                                            style="color: white;">منتشر
                                                            شده </span>
                                                        <span class="spinner-border spinner-border-sm text-light"
                                                            wire:loading
                                                            wire:target="Inactive_post({{ $post->id }})"></span>

                                                    </a>
                                                @else
                                                    <a wire:click="active_post({{ $post->id }})"
                                                        class="btn btn-raised btn-danger waves-effect"><span
                                                            style="color: white;">عدم
                                                            انتشار</span>
                                                        <span class="spinner-border spinner-border-sm text-light"
                                                            wire:loading
                                                            wire:target="active_post({{ $post->id }})"></span>
                                                    </a>
                                                @endif
                                            </div>

                                            {{-- @if ($post->is_active)
                                                <span class="badge badge-success p-2">فعال</span>
                                            @else
                                                <span class="badge badge-warning p-2">غیرفعال</span>
                                            @endif --}}
                                        </td>
                                        <td class="text-center js-sweetalert">
                                            <a href="{{ route('admin.posts.edit', $post->id) }}"
                                                wire:loading.attr="disabled"
                                                class="btn btn-raised btn-info waves-effect">
                                                <i class="zmdi zmdi-edit"></i>
                                                <span class="spinner-border spinner-border-sm text-light" wire:loading
                                                    wire:target="edit_post({{ $post->id }}) "></span>
                                            </a>

                                            <button class="btn btn-raised btn-danger waves-effect"
                                                wire:loading.attr="disabled"
                                                wire:click="del_post({{ $post->id }})">
                                                <i class="zmdi zmdi-delete"></i>
                                                <span class="spinner-border spinner-border-sm text-light" wire:loading
                                                    wire:target="del_post({{ $post->id }})"></span>
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
        {{ $posts->onEachSide(1)->links() }}
    </div>
</div>
