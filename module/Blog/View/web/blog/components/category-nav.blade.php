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
            @foreach(\ZealovBlog::post(1,10) as $key=>$value)
            <a href="{{$value['redirect']?$value['redirect']:'/blog/'.$value['id']}}" class="item">
                @if($value['thumbnail'])
                    <div class="left">
                        <div class="img-box">
                            <div class="img">
                                <img src="{{$value['thumbnail']}}" alt="">
                            </div>
                        </div>
                    </div>
                @endif
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
                    @foreach($value['categories'] as $k=>$v)
                    <a href="#" class="item-category">{{$v['name']}}</a>
                    @endforeach
                </object>
            </a>
            @endforeach
        </div>
    </div>

</section>
