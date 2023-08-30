<?php

use Illuminate\Support\Facades\Route;
use Module\AppStore\Admin\Controller\SpaController;
use Module\Blog\Admin\Controller\SpaController as BlogSpaController;

Route::get('iframe/{module}', BlogSpaController::class);
Route::get('app/{module}', SpaController::class);
Route::get('app/{module}/{id}', SpaController::class);

