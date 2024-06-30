<?php

use App\Http\Controllers\Web\Admin\Authentication\DisplayLoginViewController;
use App\Http\Controllers\Web\Admin\Authentication\ProcessAdminLoginController;
use App\Http\Controllers\Web\Admin\Authentication\ProcessAdminLogoutController;
use App\Http\Controllers\Web\Admin\Dashboard\DisplayDashboardViewController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'authentication'], function () {
    Route::get('/login', [DisplayLoginViewController::class, 'handle'])->name('admin.authentication.login.display-login-form');
    Route::post('/login', [ProcessAdminLoginController::class, 'handle'])->name('admin.authentication.login.process-login-form');
    Route::post('/logout', [ProcessAdminLogoutController::class, 'handle'])->name('admin.authentication.login.process-logout-form');
});

Route::group(['middleware' => ['auth:admin']], function () {
    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/', [DisplayDashboardViewController::class, 'handle'])->name('admin.dashboard.display-dashboard-view');
    });
});
