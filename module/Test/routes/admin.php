<?php
use Illuminate\Support\Facades\Route;
use Module\Test\Admin\Controller\TestController;


Route::get('index',[TestController::class,'index'])->middleware('Test.guest');


