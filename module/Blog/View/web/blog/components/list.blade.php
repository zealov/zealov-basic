<section class="card-panel no-pad">
    <div class="panel-list-title"><h1>{{$title}}</h1>
    </div>
    <div class="post-list">
        @foreach($data as $key=>$value)
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
                        {!! $value['description'] !!}
                    </div>
                    <div class="time">
                        {{$value['created_at']}}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <div class="pages" id="pages"></div>
</section>
