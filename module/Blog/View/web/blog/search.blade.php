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
                        <a class="last"><cite>搜索：{{request('keyword')}}</cite></a>
                    </span>
                </div>
                <div class="flex">
                    <div class="main">
                        <section class="card-panel no-pad">
                            <div class="panel-list-title"><h1>搜索：{{request('keyword')}}</h1>
                            </div>
                            <div class="post-list">
                                @foreach(\ZealovBlog::post(request('page'),10,'',request('keyword')) as $key=>$value)
                                    <a href="{{$value['redirect']?$value['redirect']:'/blog/'.$value['id']}}" class="item">
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
                </div>
            </div>
        </div>
    </div>
    @include('module::Blog.View.web.blog.components.footer')
    </body>
    @section('scripts')
        <script>
            var total = '{{ \ZealovBlog::postTotal('',request('keyword')) }}';
        </script>
    @stop
@endsection

