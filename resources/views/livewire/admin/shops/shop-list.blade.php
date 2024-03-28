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
                                    <input type="text" class="form-control" wire:model="name"
                                        placeholder="نام مشتری">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" wire:model="shop_name"
                                        placeholder="نام فروشگاه">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="header d-flex align-items-center">
                <h2><strong>لیست فروشگاه ها </strong> ( {{ $shops->total() }} )</h2>

            </div>
            <div class="body">
                <div class="loader" wire:loading.flex>
                    درحال بارگذاری ...
                </div>
                @if (count($shops) === 0)
                    <p>هیچ رکوردی وجود ندارد</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover c_table theme-color">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عکس</th>
                                    <th>نام مشتری</th>
                                    <th>نام فروشگاه</th>
                                    <th> تاریخ و زمان ثبت</th>
                                    <th>وضعیت</th>
                                    <th class="text-center">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shops as $key => $shop)
                                    <tr wire:key="name_{{ $shop->id }}">
                                        <td scope="row">{{ $key + 1 }}</td>
                                        <td>
                                            <a data-lightbox="brand-{{ $loop->index }}"
                                                data-title="{{ $shop->shopname }}"
                                                href="{{ asset('storage/shops/' . $shop->image) }}">
                                                <img src="{{ asset('storage/shops/' . $shop->image) }}"
                                                    alt="{{ $shop->shopname }}" width="48" class="img-fluid rounded"
                                                    style="min-height: 3rem;">
                                            </a>
                                        </td>
                                        <td>
                                            {{ $shop->name }}
                                        </td>
                                        <td>
                                            {{ $shop->shopname }}
                                        </td>
                                        <td>
                                            {{ verta($shop->created_at)->format('H:i Y/n/j') }}

                                        </td>
                                        <td>
                                            @if ($shop->is_active)
                                                <span class="badge badge-success p-2">فعال</span>
                                            @else
                                                <span class="badge badge-danger p-2">غیرفعال</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group">

                                                <a class="btn btn-warning"
                                                    href="{{ route('admin.shop.edit', ['shop' => $shop->id]) }}"
                                                    class="dropdown-item text-right"> ویرایش فروشگاه </a>

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
        {{ $shops->onEachSide(1)->links() }}
    </div>
</div>
