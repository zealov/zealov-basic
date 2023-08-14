<?php

namespace Module\Blog\Providers;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Zealov\ModuleClassLoader;

class AppServiceProvider extends ServiceProvider
{

    public function boot(Dispatcher $events)
    {
        ModuleClassLoader::addClass('ZealovBlog', __DIR__ . '/ZealovBlog.php');
    }


    public function register()
    {

    }
}
