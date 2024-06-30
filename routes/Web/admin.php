<?php

use App\Http\Controllers\Web\Admin\Authentication\DisplayLoginViewController;
use App\Http\Controllers\Web\Admin\Authentication\ProcessAdminLoginController;
use App\Http\Controllers\Web\Admin\Authentication\ProcessAdminLogoutController;
use App\Http\Controllers\Web\Admin\Dashboard\DisplayDashboardViewController;
use App\Http\Controllers\Web\Admin\PasswordManagement\ChangePassword\DisplayChangePasswordViewController;
use App\Http\Controllers\Web\Admin\PasswordManagement\ChangePassword\ProcessChangePasswordController;
use App\Http\Controllers\Web\Admin\PasswordManagement\ResetPassword\DisplayResetPasswordViewController;
use App\Http\Controllers\Web\Admin\PasswordManagement\ResetPassword\ProcessResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'authentication'], function () {
    Route::get('/login', [DisplayLoginViewController::class, 'handle'])->name('admin.authentication.login.display-login-form');
    Route::post('/login', [ProcessAdminLoginController::class, 'handle'])->name('admin.authentication.login.process-login-form');
    Route::post('/logout', [ProcessAdminLogoutController::class, 'handle'])->name('admin.authentication.login.process-logout-form')->middleware('auth:admin');
});

Route::group(['prefix' => 'reset-password'], function() {
    Route::get('/', [DisplayResetPasswordViewController::class, 'handle'])->name('admin.reset-password.display-reset-password-form');
    Route::post('/', [ProcessResetPasswordController::class, 'handle'])->name('admin.reset-password.process-reset-password-form');
});

Route::group(['middleware' => ['auth:admin']], function () {
    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/', [DisplayDashboardViewController::class, 'handle'])->name('admin.dashboard.display-dashboard-view');
    });
    Route::group(['prefix' => 'change-password'], function() {
        Route::get('/', [DisplayChangePasswordViewController::class, 'handle'])->name('admin.change-password.display-change-password-form');
        Route::post('/', [ProcessChangePasswordController::class, 'handle'])->name('admin.change-password.process-change-password-form');
    });
});
