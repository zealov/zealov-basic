<?php

namespace Module\EditorImageCatchConfig\Core;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use ModStart\Admin\Config\AdminMenu;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        AdminMenu::register(function () {
            return [
                [
                    'title' => '功能设置',
                    'icon' => 'tools',
                    'sort' => 300,
                    'children' => [
                        [
                            'title' => '富文本图片抓取配置设置',
                            'url' => '\Module\EditorImageCatchConfig\Admin\Controller\ConfigController@index',
                        ],
                    ]
                ],
            ];
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
