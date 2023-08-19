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
                        @include('module::Blog.View.web.blog.components.list',['title'=>"搜索：".\ZealovBlog::categoryName(request('keyword')),'data'=> \ZealovBlog::post(request('page'),10,'',request('keyword'))])
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

