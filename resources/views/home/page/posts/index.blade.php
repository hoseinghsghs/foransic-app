@extends('home.layout.MasterHome')
@section('title', 'خانه - پست ها')

@section('content')
    <!-- Start of Main -->
    <main class="main-row">
        <div id="breadcrumb">
            <i class="mdi mdi-home"></i>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">خانه</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('home.posts.index') }}">بلاگ</a>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="container-main">
            <div class="d-block">
                <div class="col-lg-9 col-md-8 col-xs-12 pr mt-3">
                    <section class="content-widget">
                        @if (count($posts) === 0)
                            <p style="text-align: center">هیچ رکوردی وجود ندارد</p>
                        @else
                            @foreach ($posts as $post)
                                <article class="post-item" style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;">
                                    <div class="post-thumb">
                                        <a href="{{ route('home.posts.show', ['post' => $post->slug]) }}" class="d-block">
                                            <img src="{{ url('storage/' . $post->image->url) }}" alt="{{ $post->title }}">
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <div class="title">
                                            <a href="{{ route('home.posts.show', ['post' => $post->slug]) }}">
                                                <h2 class="title-tag">{{ $post->title }}
                                                </h2>
                                            </a>
                                        </div>
                                        </br>
                                        <div class="excerpt">
                                            {!! $post->main_body !!}
                                            <span class="post-date">
                                                <i class="fa fa-calendar"></i>
                                                {{ Hekmatinasser\Verta\Verta::instance($post->created_at)->format('Y/n/j') }}
                                            </span>
                                        </div>
                                </article>
                            @endforeach
                        @endif
                    </section>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-12 pr mt-3 sticky-sidebar">
                    <div class="shortcode-widget-area-sidebar">
                        <section class="widget-posts">
                            <section class="widget-posts">
                                <div class="header-sidebar mb-3">
                                    <h3>دسته بندی ها</h3>
                                </div>
                                <div class="content-sidebar">
                                    <div class="widget widget_categories">
                                        @foreach ($posts_category as $post_category)
                                            <div class="item">
                                                <div class="item-inner">
                                                    <a href="{{ route('home.posts.list', $post_category->category) }}">{{ $post_category->category }}
                                                        <span
                                                            class="post-count">({{ \App\Models\Post::where('category', $post_category->category)->count() }})</span></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                            </section>
                            <div class="header-sidebar mb-3">
                                <h3> برگزیده ها</h3>
                            </div>
                            <div class="content-sidebar">
                                @foreach ($popular_posts as $popular_post)
                                    <div class="item" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                                        <div class="item-inner">
                                            <div class="item-thumb">
                                                <a href="{{ route('home.posts.show', ['post' => $popular_post->slug]) }}"
                                                    class="img-holder d-block">
                                                    <img src="{{ url('storage/' . $popular_post->image->url) }}"
                                                        alt="{{ $popular_post->title }}">
                                                </a>
                                            </div>
                                            <div class="title">
                                                <a href="{{ route('home.posts.show', ['post' => $popular_post->slug]) }}">
                                                    <h2 class="title-tag">{{ $popular_post->title }}</h2>
                                                </a>
                                                <div></div>
                                                <span class="post-date">
                                                    {{ Hekmatinasser\Verta\Verta::instance($post->created_at)->format('Y/n/j') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    </div>
                </div>
                <div class="pagination-product pr-3 pl-3 pr">
                    <nav aria-label="Page navigation example">
                        {{ $posts->links() }} </nav>
                </div>

            </div>
        </div>
    </main>
<!-- End of Main -->@endsection
