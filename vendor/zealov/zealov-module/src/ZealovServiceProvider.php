<?php

namespace Zealov;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Zealov\Kernel\Traits\ModuleTrait;

class ZealovServiceProvider extends ServiceProvider
{
    use ModuleTrait;

    protected $commands = [
        \Zealov\Command\AssertPublishCommand::class,
    ];

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'zealov');
        $this->loadViewsFrom(base_path('module'), 'module');

        $this->publishes([__DIR__ . '/../asset' => public_path('asset')], 'zealov');

        $this->registerModuleRoutes();
        $this->registerDefaultRoutes();

    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/zealov.php', 'zealov');
        $this->loadAdminAuthConfig();
        $this->registerModuleMiddlewares();
        $this->commands($this->commands);
    }

    protected function loadAdminAuthConfig()
    {
        config(Arr::dot(config('zealov.auth', []), 'auth.'));
    }


    /**
     * 注册模块中间件
     * @return void
     */
    public function registerModuleMiddlewares()
    {
        $modules = self::moduleScandir();

        $router = app('router');

        foreach ($modules as $module) {

            $file = self::path($module, 'config/config.php');

            if (!file_exists($file)) {
                continue;
            }

            $config = require $file;

            if (!isset($config['middlewares'])) {
                continue;
            }
            if (!is_array($config['middlewares'])) {
                continue;
            }
            foreach ($config['middlewares'] as $key => $middleware) {
                if (method_exists($router, 'aliasMiddleware')) {
                    $router->aliasMiddleware($module . '.' . $key, $middleware);
                }
                $router->middleware($module . '.' . $key, $middleware);
            }
        }
    }


    public function registerDefaultRoutes()
    {
        Route::prefix(config('zealov.admin.prefix'))->group(__DIR__ . '/../routes/admin.php');
        Route::prefix(config('zealov.api.prefix'))->group(__DIR__ . '/../routes/api.php');
    }

    /**
     * 注册模块路由
     * @return void
     */
    public function registerModuleRoutes()
    {
        $modules = self::moduleScandir();

        $routes = config('zealov.routes');

        foreach ($modules as $module) {
            foreach ($routes as $key => $route) {
                $file = self::path($module, $route);
                if (file_exists($file)) {
                    Route::prefix($this->prefix($module, $key))->group($file);
                }
            }
        }
    }

    /**
     * 获取配置前缀
     * @param $module
     * @param $key
     * @return mixed
     */

    public function prefix($module, $key)
    {
        $config = config('zealov');

        $prefix = $config[$key]['prefix'];

        $file = self::path($module, 'config/config.php');

        if (!file_exists($file)) {
            return $prefix;
        }

        $config = require $file;

        if (!isset($config[$key]['prefix'])) {
            return $prefix;
        }
        return $config[$key]['prefix'];
    }


}
