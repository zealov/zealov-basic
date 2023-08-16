@extends($_viewFrame)
@section('title')
    {{\ZealovBlog::postDetail(Request::route('id'),'name')}}-{{app('SystemConfig')->value('siteName')}}
@endsection
@section('keywords')
    {{\ZealovBlog::postDetail(Request::route('id'),'sub_name')}}
@endsection
@section('description')
    {{\ZealovBlog::postDetail(Request::route('id'),'description')}}
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
                        <a href="/blog">博客</a>
                        <a class="/blog/{{Request::route('id')}}"><cite>{{\ZealovBlog::postDetail(Request::route('id'),'name')}}</cite></a>
                    </span>
                </div>
                <div class="flex">
                    <div class="main">
                        <section class="card-panel no-pad">
                            <div class="page-container">
                                <div class="article-title">
                                    <h1>{{\ZealovBlog::postDetail(Request::route('id'),'name')}}</h1>
                                    <div class="article-info">
                                        {{\ZealovBlog::postDetail(Request::route('id'),'created_at')}}
                                    </div>
                                </div>
                                <div class="page-content">
                                    {!! \ZealovBlog::postDetail(Request::route('id'),'content') !!}
                                </div>
                            </div>
                        </section>
                        <div class="entry-page">
                            <div class="layui-row row-flex layui-col-space15">

                                <div class="layui-col-md6 layui-col-sm6 layui-col-xs12">
                                    @if(\ZealovBlog::postDetailPrev(Request::route('id'),'id'))
                                        <a class="page-item" style="background-color: #409EFF"
                                           href="{{\ZealovBlog::postDetailPrev(Request::route('id'),'redirect')?\ZealovBlog::postDetailPrev(Request::route('id'),'redirect'):'/blog/'.\ZealovBlog::postDetailPrev(Request::route('id'),'id')}}">
                                            <div class="title">
                                                {{\ZealovBlog::postDetailPrev(Request::route('id'),'name')}}
                                            </div>
                                            <div class="info-box">
                                                <div class="icon-box">
                                                    <i class="iconfont icon-left"></i> 上一篇
                                                </div>
                                                <div class="time">
                                                    {{\ZealovBlog::postDetailPrev(Request::route('id'),'created_at')}}
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                                <div class="layui-col-md6 layui-col-sm6 layui-col-xs12">
                                    @if(\ZealovBlog::postDetailNext(Request::route('id'),'id'))
                                        <a class="page-item" style="background-color: #55E05C"
                                           href="{{\ZealovBlog::postDetailNext(Request::route('id'),'redirect')?\ZealovBlog::postDetailNext(Request::route('id'),'redirect'):'/blog/'.\ZealovBlog::postDetailNext(Request::route('id'),'id')}}">
                                            <div class="title">
                                                {{\ZealovBlog::postDetailNext(Request::route('id'),'name')}}
                                            </div>
                                            <div class="info-box">

                                                <div class="time">
                                                    {{\ZealovBlog::postDetailNext(Request::route('id'),'created_at')}}
                                                </div>
                                                <div class="icon-box">
                                                    下一篇 <i class="iconfont icon-right"></i>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar">
                        @include('module::Blog.View.web.blog.components.sidebar-panel',['title'=>'随机内容','data'=> \ZealovBlog::inRandomOrder(10,request('category'))])
                        @include('module::Blog.View.web.blog.components.sidebar-panel',['title'=>'最新文章','data'=> \ZealovBlog::post(1,5)])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('module::Blog.View.web.blog.components.footer')
    </body>
@endsection

