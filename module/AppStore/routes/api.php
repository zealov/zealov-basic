<?php

use Illuminate\Support\Facades\Route;
use Module\AppStore\Api\Controller\AppStoreController;

Route::post('appStore/install', [AppStoreController::class, 'install']);
