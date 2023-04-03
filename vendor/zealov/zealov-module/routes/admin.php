<?php
use Illuminate\Support\Facades\Route;



Route::get('admin/index',[\Zealov\Controllers\Admin\TestController::class,'index']);
Route::get('admin/index1',[\Zealov\Controllers\Admin\TestController::class,'index1']);
Route::get('admin/index2',[\Zealov\Controllers\Admin\TestController::class,'index2']);
Route::get('admin/index3',[\Zealov\Controllers\Admin\TestController::class,'index2']);
Route::get('login',[\Zealov\Controllers\Admin\SpaController::class,'index']);


