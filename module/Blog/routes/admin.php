<?php

use Illuminate\Support\Facades\Route;
use Module\Blog\Admin\Controller\CategoryController;
use Module\Blog\Admin\Controller\NavigationController;
use Module\Blog\Admin\Controller\PostController;


Route::get('blog/navigation', [NavigationController::class, 'index'])->name('admin.blog.navigation');
Route::get('blog/category', [CategoryController::class, 'index'])->name('admin.blog.category');
Route::get('blog/post', [PostController::class, 'index'])->name('admin.blog.post');
Route::get('blog/post_create', [PostController::class, 'index'])->name('admin.blog.create');
Route::get('blog/post_edit/{id}', [PostController::class, 'edit'])->name('admin.blog.edit');
