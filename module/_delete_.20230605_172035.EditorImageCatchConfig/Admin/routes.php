<?php

/* @var \Illuminate\Routing\Router $router */

$router->match(['get', 'post'], 'editor_image_catch_config/config', 'ConfigController@index');
