<?php

use Illuminate\Support\Facades\Route;
use Module\Blog\Admin\Controller\CategoryController;
use Module\Blog\Admin\Controller\NavigationController;
use Module\Blog\Admin\Controller\PostController;


Route::get('blog/navigation', [NavigationController::class, 'index'])->name('admin.blog.navigation');
Route::get('blog/category', [CategoryController::class, 'index'])->name('admin.blog.category');
Route::get('blog/post', [PostController::class, 'index'])->name('admin.blog.post');
Route::get('blog/post_create', [PostController::class, 'index'])->name('admin.blog.create');
Route::get('blog/post_edit/{id}', [PostController::class, 'index'])->name('admin.blog.edit');
Route::get('blog/siteConfig', [PostController::class, 'index'])->name('admin.system.siteConfig');

Route::get('blog/page', [PostController::class, 'index'])->name('admin.blog.page');
Route::get('blog/page_create', [PostController::class, 'index'])->name('admin.blog.page.create');
Route::get('blog/page_edit/{id}', [PostController::class, 'index'])->name('admin.blog.page.edit');

