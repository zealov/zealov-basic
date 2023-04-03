<?php

return [
    'routes' => [
        'admin' => 'routes/admin.php',
        'web'   => 'routes/web.php',
        'api'   => 'routes/api.php'
    ],
    'admin'  => [
        'prefix' => trim(env('ADMIN_PATH', 'admin'), '/'),
    ],
    'web' => [
        'prefix' => trim(env('APP_PATH', ''), '/'),
    ],
    'api' => [
        'prefix' => trim(env('API_PATH', 'api'), '/'),
    ],
    'auth'=>[
        'guard' => 'admin',
        'guards' => [
            'admin' => [
                'driver' => 'jwt',
                'provider' => 'admin',
            ],
        ],
        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model' => \Zealov\Models\Admin::class
            ],
        ],
    ]
];
