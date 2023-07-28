<?php

use Illuminate\Support\Facades\Route;
use Module\Blog\Api\Controller\CategoryController;
use Module\Blog\Api\Controller\ChunkController;
use Module\Blog\Api\Controller\ConfigController;
use Module\Blog\Api\Controller\FileSystemController;
use Module\Blog\Api\Controller\NavigationController;
use Module\Blog\Api\Controller\PageController;
use Module\Blog\Api\Controller\PostController;
use Module\Blog\Api\Controller\RelationshipController;

//导航
Route::get('blog/navigation', [NavigationController::class, 'index']);
Route::get('blog/navigation/{id}', [NavigationController::class, 'show']);
Route::put('blog/navigation/{id}', [NavigationController::class, 'update']);
Route::post('blog/navigation', [NavigationController::class, 'store']);
Route::post('blog/navigation/updateSort', [NavigationController::class, 'updateSort']);
Route::delete('blog/navigation/{id}', [NavigationController::class, 'destroy']);

//组块
Route::get('blog/chunk/type', [ChunkController::class, 'type']);
Route::post('blog/chunk', [ChunkController::class, 'store']);
Route::post('blog/chunk/relationship', [ChunkController::class, 'relationship']);

//分类
Route::get('blog/category', [CategoryController::class, 'index']);
Route::get('blog/category/{id}', [CategoryController::class, 'show']);
Route::put('blog/category/{id}', [CategoryController::class, 'update']);
Route::post('blog/category', [CategoryController::class, 'store']);
Route::post('blog/category/updateSort', [CategoryController::class, 'updateSort']);
Route::delete('blog/category/{id}', [CategoryController::class, 'destroy']);

//文章
Route::get('blog/post', [PostController::class, 'index']);
Route::get('blog/post/{id}', [PostController::class, 'show']);
Route::post('blog/post', [PostController::class, 'store']);
Route::put('blog/post/{id}', [PostController::class, 'update']);
Route::delete('blog/post/{id}', [PostController::class, 'destroy']);

//页面
Route::get('blog/page', [PageController::class, 'index']);
Route::get('blog/page/all', [PageController::class, 'all']);
Route::get('blog/page/{id}', [PageController::class, 'show']);
Route::post('blog/page', [PageController::class, 'store']);
Route::put('blog/page/{id}', [PageController::class, 'update']);
Route::delete('blog/page/{id}', [PageController::class, 'destroy']);

//站点配置
Route::post('blog/config', [ConfigController::class, 'store']);
Route::put('blog/config/{id}', [ConfigController::class, 'update']);
Route::get('blog/config', [ConfigController::class, 'index']);
Route::get('blog/config/group', [ConfigController::class, 'group']);
Route::get('blog/config/{id}', [ConfigController::class, 'show']);


//文件上传
Route::put('blog/file/{id}', [FileSystemController::class, 'update']);
Route::post('blog/file/upload', [FileSystemController::class, 'upload']);
Route::post('blog/file', [FileSystemController::class, 'store']);
Route::get('blog/file', [FileSystemController::class, 'index']);
Route::get('blog/file/{id}', [FileSystemController::class, 'show']);

//关联
Route::get('blog/relationship/entity',[RelationshipController::class,'entity']);
