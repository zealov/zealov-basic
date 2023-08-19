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
                        @include('module::Blog.View.web.blog.components.list',['title'=>\ZealovBlog::categoryName(request('category')),'data'=> \ZealovBlog::post(request('page'),10,request('category'))])
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

