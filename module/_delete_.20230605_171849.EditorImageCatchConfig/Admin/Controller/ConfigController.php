<?php

namespace Module\EditorImageCatchConfig\Admin\Controller;

use Illuminate\Routing\Controller;
use ModStart\Admin\Layout\AdminConfigBuilder;

class ConfigController extends Controller
{
    public function index(AdminConfigBuilder $builder)
    {
        $builder->pageTitle('富文本图片抓取设置');
        $builder->values('Data_RemoteCatchIgnoreDomains', '图片抓取域名忽略')->help('如配置 example.com 则当图片地址为 http://example.com/test.jpg 忽略抓取');
        $builder->formClass('wide');
        return $builder->perform();
    }

}
