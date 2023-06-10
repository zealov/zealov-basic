<?php

use Illuminate\Support\Facades\Route;
use Module\AppStore\Api\Controller\AppStoreController;
use Module\AppStore\Api\Controller\StoreController;

Route::post('appStore/install', [AppStoreController::class, 'install']);
Route::post('appStore/uninstall', [AppStoreController::class, 'uninstall']);
Route::post('appStore/enable', [AppStoreController::class, 'enable']);
Route::post('appStore/disable', [AppStoreController::class, 'disable']);
Route::post('appStore/all', [AppStoreController::class, 'all']);



Route::get('store/module', [StoreController::class, 'module']);
