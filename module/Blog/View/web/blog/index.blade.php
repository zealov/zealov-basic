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
    <div class="container-wrap">
        <div class="layui-container">
            <div class="flex">
                <div class="main">
                    @include('module::Blog.View.web.blog.components.banner')
                    @include('module::Blog.View.web.blog.components.category-nav')
                </div>
                <div class="sidebar">
                    @include('module::Blog.View.web.blog.components.profile')
                    <div class="margin-top-20"></div>
                    @foreach(\ZealovBlog::navigationChunk('index') as $key=>$value)
                        @include('module::Blog.View.web.blog.components.sidebar-panel',['title'=>$value['name'],'data'=> \ZealovBlog::relationship('index',$value['name'],1,10)])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('module::Blog.View.web.blog.components.footer')
    </body>
@endsection

