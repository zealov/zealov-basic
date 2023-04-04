<?php
use Illuminate\Support\Facades\Route;



Route::get('home',[\Zealov\Controllers\Admin\SpaController::class,'index']);
Route::get('login',[\Zealov\Controllers\Admin\SpaController::class,'index']);


