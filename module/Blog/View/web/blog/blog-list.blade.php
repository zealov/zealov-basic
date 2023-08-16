@extends($_viewFrame)

@section('title')
    {{app('SystemConfig')->value('siteName')}}
@endsection
@section('keywords')
    {{app('SystemConfig')->value('siteKeywords')}}
@endsection
@section('description')
    {{app('SystemConfig')->value('siteDescription')}}
@endsection

@section('body')
    <body class="header-white">
    @include('module::Blog.View.web.blog.components.header')
    <div class="main">
        <div class="container-wrap">
            <div class="layui-container">
                <div class="breadcrumb">
                    <span class="layui-breadcrumb">
                        <a href="/"> 首页</a>
                        <a class="last" href="/blog?category={{\ZealovBlog::categoryName(request('category'))}}"><cite>{{\ZealovBlog::categoryName(request('category'))}}</cite></a>
                    </span>
                </div>
                <div class="flex">
                    <div class="main">
                        <section class="card-panel no-pad">
                            <div class="panel-list-title"><h1>{{\ZealovBlog::categoryName(request('category'))}}</h1>
                            </div>
                            <div class="post-list">
                                @foreach(\ZealovBlog::post(request('page'),10,request('category')) as $key=>$value)
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
                    </div>
                    <div class="sidebar">
                        @include('module::Blog.View.web.blog.components.sidebar-panel',['title'=>'随机内容','data'=> \ZealovBlog::inRandomOrder(10,request('category'))])
                        @include('module::Blog.View.web.blog.components.sidebar-panel',['title'=>'最新文章','data'=> \ZealovBlog::post(1,10)])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('module::Blog.View.web.blog.components.footer')
    </body>
    @section('scripts')
        <script>
            var total = '{{ \ZealovBlog::postTotal(request('category')) }}';
        </script>
    @stop
@endsection

