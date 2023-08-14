@extends($_viewFrame)

@section('title'){{app('SystemConfig')->value('siteName')}}@endsection
@section('keywords'){{app('SystemConfig')->value('siteKeywords')}}@endsection
@section('description'){{app('SystemConfig')->value('siteDescription')}}@endsection

{!! \Zealov\Zealov::css('asset/layui/css/layui.css') !!}
{!! \Zealov\Zealov::css('asset/common/css/video-js.min.css') !!}
{!! \Zealov\Zealov::css('asset/common/css/swiper-bundle.min.css') !!}
{!! \Zealov\Zealov::css('asset/common/css/iconfont.css') !!}
{!! \Zealov\Zealov::css('asset/common/css/animate.min.css') !!}
{!! \Zealov\Zealov::css('asset/common/css/css.css') !!}
{!! \Zealov\Zealov::css('asset/common/css/style.css') !!}

@section('body')
    <body class="header-white">
        @include('module::Blog.View.web.blog.components.header')
        <div class="container-wrap">
            <div class="layui-container">
                <div class="flex">
                    <div class="main">
                        <!-- banner -->
                        @include('module::Blog.View.web.blog.components.banner')
{{--                        @include('module::Blog.View.web.blog.components.topic')--}}
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
{{--                                    <a href="user_center.php" class="edit-btn">--}}
{{--                                        编辑--}}
{{--                                    </a>--}}
                                </div>
                                <div class="tip">心之客栈网站编辑，精选心理学和情感内容</div>
{{--                                <div class="profile-stats">--}}
{{--                                    <div class="item">--}}
{{--                                        <div class="num">360</div>--}}
{{--                                        <div class="txt">文章</div>--}}
{{--                                    </div>--}}
{{--                                    <div class="item">--}}
{{--                                        <div class="num">3</div>--}}
{{--                                        <div class="txt">评论</div>--}}
{{--                                    </div>--}}
{{--                                    <div class="item">--}}
{{--                                        <div class="num">1</div>--}}
{{--                                        <div class="txt">粉丝</div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="btn-box">--}}
{{--                                    <div class="btn">--}}
{{--                                        <i class="iconfont icon-plus"></i> 关注--}}
{{--                                    </div>--}}
{{--                                    <div class="btn">--}}
{{--                                        <i class="iconfont icon-mail"></i> 私信--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </section>
                        <section class="sidebar-panel">
                            <div class="sidebar-title">
                                欢迎光临
                            </div>
                            <div class="sidebar-content">
                                <p>
                                    每日精选内容，主要包括：心理学知识，心理问题，人际关系，情感问题，家庭教育和生活感悟。帮助您：提高自我认知，调整心态，强大内心，学会情绪和压力管理，改变行为习惯，成就幸福人生。— 心之客栈
                                </p>
                            </div>
                        </section>
{{--                        <section class="sidebar-panel">--}}
{{--                            <div class="sidebar-search">--}}
{{--                                <input type="text" name="keyword" class="layui-input" placeholder="输入关键词搜索...">--}}
{{--                                <button type="submit" class="form-submit"><i class="iconfont icon-search1"></i></button>--}}
{{--                            </div>--}}
{{--                        </section>--}}
                        <section class="sidebar-panel">
                            <div class="sidebar-title">
                                热门标签
                            </div>
                            <div class="sidebar-content">
                                <div class="tag-list">
                                    <a href="post_list.php" class="tag-item">男人</a>
                                    <a href="post_list.php" class="tag-item">孩子</a>
                                    <a href="post_list.php" class="tag-item">女人</a>
                                    <a href="post_list.php" class="tag-item">人生</a>
                                    <a href="post_list.php" class="tag-item">婚姻</a>
                                    <a href="post_list.php" class="tag-item">生活</a>
                                    <a href="post_list.php" class="tag-item">男人</a>
                                    <a href="post_list.php" class="tag-item">孩子</a>
                                    <a href="post_list.php" class="tag-item">女人</a>
                                    <a href="post_list.php" class="tag-item">人生</a>
                                    <a href="post_list.php" class="tag-item">婚姻</a>
                                    <a href="post_list.php" class="tag-item">生活</a>
                                </div>
                            </div>
                        </section>
                        <section class="sidebar-panel">
                            <div class="sidebar-title">
                                心理问题
                            </div>
                            <div class="sidebar-content">
                                <ul class="sidebar-list">
                                    <li>
                                        <a href="#">
                                            成功人士有这10个特点，努力向他们学习
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            成功人士有这10个特点，努力向他们学习
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            成功人士有这10个特点，努力向他们学习
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            成功人士有这10个特点，努力向他们学习
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </section>
                        <section class="sidebar-panel">
                            <div class="sidebar-title">
                                心理问题
                            </div>
                            <div class="sidebar-content">
                                <ul class="sidebar-list">
                                    <li>
                                        <a href="#">
                                            成功人士有这10个特点，努力向他们学习
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            成功人士有这10个特点，努力向他们学习
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            成功人士有这10个特点，努力向他们学习
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            成功人士有这10个特点，努力向他们学习
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </section>
                        <section class="sidebar-panel">
                            <div class="sidebar-title">
                                心理问题
                            </div>
                            <div class="sidebar-content">
                                <ul class="sidebar-list">
                                    <li>
                                        <a href="#">
                                            成功人士有这10个特点，努力向他们学习
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            成功人士有这10个特点，努力向他们学习
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            成功人士有这10个特点，努力向他们学习
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            成功人士有这10个特点，努力向他们学习
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        @include('module::Blog.View.web.blog.components.footer')
    </body>
@endsection

