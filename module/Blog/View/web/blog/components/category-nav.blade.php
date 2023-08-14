<section class="card-panel no-pad" >
    <div class="category-nav">
        <div class="category-swiper">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide active">
                        <div class="item">
                            最新文章
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-wrap">
        <div class="post-list">
            @foreach(\ZealovBlog::post(1,15) as $key=>$value)
            <a href="{{$value['redirect']}}" class="item">
                <div class="left">
                    <div class="img-box">
                        <div class="img">
                            <img src="{{$value['thumbnail']}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="title">
                        {{$value['name']}}
                    </div>
                    <div class="desc">
                        {{$value['description']}}
                    </div>
                    <div class="time">
                        {{$value['created_at']}}
                    </div>
                </div>
                <object>
                    <a href="#" class="item-category">亲子关系</a>
                </object>
            </a>
            @endforeach
        </div>
{{--        <div class="button">--}}
{{--            <a href="javascript:;">点击查看更多</a>--}}
{{--        </div>--}}
    </div>

</section>
