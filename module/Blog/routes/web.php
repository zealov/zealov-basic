<?php

use Illuminate\Support\Facades\Route;
use Module\Blog\Web\Controller\IndexController;

Route::get('', [IndexController::class,'index']);
