<div>
    <!-- Hover Rows -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-md-4 col-sm-6">
                            <input type="text" placeholder="کلمات کلیدی" name="title" wire:model.defer="keyword_name"
                                class="form-control">
                            @error('keyword_name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-auto">
                            <button wire:click="addKeyword" wire:loading.attr="disabled"
                                class="btn btn-raised {{ $is_edit ? 'btn-warning' : 'btn-primary' }}  waves-effect">
                                {{ $is_edit ? 'ویرایش' : 'افزودن' }}
                                <span class="spinner-border spinner-border-sm text-light" wire:loading
                                    wire:target="addKeyword"></span>
                            </button>
                            @if ($is_edit)
                                <button class="btn btn-raised btn-info waves-effect" wire:loading.attr="disabled"
                                    wire:click="ref">صرف نظر
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
                    <h2><strong>لیست کلمات کلیدی ها </strong>( {{ $keywords->total() }} )</h2>
                </div>
                <div class="body">
                    @if (count($keywords) === 0)
                        <p>هیچ رکوردی وجود ندارد</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover c_table theme-color">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان</th>
                                        <th class="text-center js-sweetalert">عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keywords as $Keyword)
                                        <tr wire:key="{{ $Keyword->title }} {{ $Keyword->id }}"
                                            wire:loading.attr="disabled">
                                            <td scope="row">{{ $Keyword->id }}</td>
                                            <td>{{ $Keyword->title }}</td>
                                            <td class="text-center js-sweetalert">

                                                <button wire:click="edit_Keyword({{ $Keyword->id }})"
                                                    wire:loading.attr="disabled" {{ $display }}
                                                    class="btn btn-raised btn-info waves-effect scroll">
                                                    <i class="zmdi zmdi-edit"></i>
                                                    <span class="spinner-border spinner-border-sm text-light"
                                                        wire:loading
                                                        wire:target="edit_Keyword({{ $Keyword->id }}) "></span>
                                                </button>

                                                <button class="btn btn-raised btn-danger waves-effect"
                                                    wire:loading.attr="disabled"
                                                    wire:click="del_Keyword({{ $Keyword->id }})" {{ $display }}>
                                                    <i class="zmdi zmdi-delete"></i>

                                                    <span class="spinner-border spinner-border-sm text-light"
                                                        wire:loading
                                                        wire:target="del_Keyword({{ $Keyword->id }})"></span>
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
@push('scripts')
    <script>
        $('.scroll').click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    </script>
@endpush
