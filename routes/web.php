<?php

use Illuminate\Support\Facades\Route;

// Route::prefix('/applicant')->group(__DIR__ . '/Web/applicant.php');
Route::prefix('/admin')->group(__DIR__.'/Web/admin.php');
Route::prefix('/')->group(__DIR__.'/Web/public.php');
