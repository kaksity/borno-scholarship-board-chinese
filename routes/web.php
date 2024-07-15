<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->route('applicant.authentication.login.display-login-form');
});

Route::prefix('/applicant')->group(__DIR__ . '/Web/applicant.php');
Route::prefix('/admin')->group(__DIR__.'/Web/admin.php');
