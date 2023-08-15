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
                    <!-- banner -->
                    @include('module::Blog.View.web.blog.components.banner')
                    @include('module::Blog.View.web.blog.components.category-nav')
                </div>
                <div class="sidebar">
                    <section class="sidebar-profile">
                        <div class="profile-cover">
                            <div class="img">
                                <img src="images/mine-cover.jpeg" alt="">
                            </div>
                        </div>
                        <div class="profile-info">
                            <div class="avatar-wrap">
                                <img src="./images/avatar.jpg" alt="">
                            </div>
                            <div class="name-box">
                                <div class="name">
                                    AI心语
                                </div>
                            </div>
                            <div class="tip">心之客栈网站编辑，精选心理学和情感内容</div>
                        </div>
                    </section>
                    @include('module::Blog.View.web.blog.components.sidebar-panel',['title'=>'情感问题','data'=> \ZealovBlog::relationship('index','情感问题',1,10)])
                    @include('module::Blog.View.web.blog.components.sidebar-panel',['title'=>'人际关系','data'=> \ZealovBlog::relationship('index','人际关系',1,10)])
                    @include('module::Blog.View.web.blog.components.sidebar-panel',['title'=>'旅行日记','data'=> \ZealovBlog::relationship('index','旅行日记',1,10)])
                </div>
            </div>
        </div>
    </div>
    @include('module::Blog.View.web.blog.components.footer')
    </body>
@endsection

