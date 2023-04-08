<?php
use Illuminate\Support\Facades\Route;
use Module\Blog\Admin\Controller\CategoryController;
use Module\Blog\Admin\Controller\NavigationController;


Route::get('blog/navigation',[NavigationController::class,'index'])->name('admin.blog.navigation');
Route::get('blog/category',[CategoryController::class,'index'])->name('admin.blog.category');
