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
                <div class="flex">
                    <div class="main">
                        <section class="card-panel no-pad">
                            <div class="page-container">
                                <div class="article-title text-center">
                                    <h1>{{\ZealovBlog::page('/'.request()->path(),'name')}}</h1>
                                </div>
                                <div class="page-content">
                                    {!! \ZealovBlog::page('/'.request()->path(),'content') !!}
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('module::Blog.View.web.blog.components.footer')
    </body>
@endsection

