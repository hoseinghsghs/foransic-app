<!-- adplacement--------------------------->
<div class="container-fluid">
    <div class="row">
        <div class="adplacement-container-row my-0 container-main container-xlg">
            @foreach ($headers as $header)
                <div class="col-4 col-lg-2 p-1 pr">
                    <a href="{{ $header->button_link }}" class="adplacement-item m-1 "
                        style="box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0.1);">
                        <div class="adplacement-sponsored_box mb-2">
                            <img src="{{ url(env('BANNER_IMAGES_PATCH') . $header->image) }}" alt="{{ $header->title }}">
                        </div>
                        <h2
                            style="font-size: 0.79rem;
                                    text-align: center;
                                    padding-top: 0.5rem;
                                    color: #6c757d;">
                            {{ $header->title }}
                        </h2>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- adplacement--------------------------->
