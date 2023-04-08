<?php
use Illuminate\Support\Facades\Route;
use Module\Blog\Api\Controller\CategoryController;
use Module\Blog\Api\Controller\FileSystemController;
use Module\Blog\Api\Controller\NavigationController;


Route::get('blog/navigation',[NavigationController::class,'index']);
Route::get('blog/navigation/{id}',[NavigationController::class,'show']);
Route::put('blog/navigation/{id}',[NavigationController::class,'update']);
Route::post('blog/navigation',[NavigationController::class,'store']);
Route::post('blog/navigation/updateSort', [NavigationController::class, 'updateSort']);
Route::delete('blog/navigation/{id}', [NavigationController::class, 'destroy']);


Route::get('blog/category',[CategoryController::class,'index']);
Route::get('blog/category/{id}',[CategoryController::class,'show']);
Route::put('blog/category/{id}',[CategoryController::class,'update']);
Route::post('blog/category',[CategoryController::class,'store']);
Route::post('blog/category/updateSort', [CategoryController::class, 'updateSort']);
Route::delete('blog/category/{id}', [CategoryController::class, 'destroy']);

//文件上传
Route::post('blog/file/upload', [FileSystemController::class, 'upload']);
