<?php

use Illuminate\Support\Facades\Route;
use Module\Blog\Web\Controller\IndexController;

Route::get('', [IndexController::class,'index']);
Route::get('blog', [IndexController::class,'blog']);
Route::get('blog/{id}', [IndexController::class,'detail']);
Route::get('page/about', [IndexController::class,'page']);
Route::get('search', [IndexController::class,'search']);
