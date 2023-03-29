<?php
use Illuminate\Support\Facades\Route;



Route::post('me',[\Zealov\Controllers\Api\AuthController::class,'getUserInfo']);
Route::get('me',[\Zealov\Controllers\Api\AuthController::class,'getUserInfo']);


