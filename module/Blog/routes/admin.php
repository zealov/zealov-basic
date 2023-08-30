<?php

use Illuminate\Support\Facades\Route;
use Module\Blog\Admin\Controller\SpaController;
Route::get('home',SpaController::class);
Route::get('blog/{module}', SpaController::class);
Route::get('blog/{module}/{id}', SpaController::class);

