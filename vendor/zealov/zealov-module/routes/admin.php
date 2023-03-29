<?php
use Illuminate\Support\Facades\Route;



Route::get('admin/index',[\Zealov\Controllers\Admin\TestController::class,'index']);
Route::get('admin/index1',[\Zealov\Controllers\Admin\TestController::class,'index1']);
Route::get('admin/index2',[\Zealov\Controllers\Admin\TestController::class,'index2']);


