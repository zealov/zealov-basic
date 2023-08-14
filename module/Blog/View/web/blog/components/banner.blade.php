<div class="banner">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach(\ZealovBlog::relationship('index','轮播图') as $key=>$value)
            <a href="{{$value['redirect']}}" class="swiper-slide">
                <div class="slide-inner" style="background-image: url({{$value['path']}});">
                    <div class="title">
                        {{$value['name']}}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
