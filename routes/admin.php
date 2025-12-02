<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\User\UserController;


Route::prefix('admin/v1')->group(function () {
    Route::apiResource('users', UserController::class)->names('user');
});

