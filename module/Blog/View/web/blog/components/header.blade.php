<div class="headerTemp"></div>
<header class="fixed show">
    <div class="header">
        <div class="header-top">
            <div class="layui-container">
                <div class="flex">
                    <div class="logo">
                        <a href="/" class="logo-black"><img src="{{\ZealovBlog::systemConfig('siteLogo')}}" alt=""></a>
                    </div>
                    <div class="header-main">
                        <div class="header-nav">
                            <div class="mobile-bg"></div>
                            <ul class="layui-nav nav-horizon" lay-filter="" id="resText">
                                <li class="show-mobile">
                                    <div class="close-btn"><i class="iconfont icon-close"></i></div>
                                </li>
                                @foreach(\ZealovBlog::navigation() as $key=>$value)
                                    <li class="layui-nav-item @if(request()->path()==trim($value['url'],'/') || request()->path()==$value['url']) active @endif">
                                        <a href="{{$value['url']}}">{{$value['name']}}</a>
                                        @if(isset($value['children']))
                                            <dl class="layui-nav-child">
                                                <div class="dropmenu">
                                                    <div class="dropmenu-container">
                                                        @foreach($value['children'] as $k=>$v)
                                                        <dd class="sub-title"><a href="{{$v['url']}}">{{$v['name']}}</a></dd>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </dl>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                        <div class="search-box">
                            <input type="text" name="keyword" id="keyword" class="layui-input" placeholder="输入关键词搜索...">
                            <button type="submit" class="form-submit"><i class="iconfont icon-search1"></i></button>
                            <span class="close-btn">
                                <i class="iconfont icon-close"></i>
                            </span>
                        </div>
                        <div class="search-btn">
                            <i class="iconfont icon-search1"></i>
                        </div>
                        <div class="menu-toggle">
                            <div class="toggle-iconfont">
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
