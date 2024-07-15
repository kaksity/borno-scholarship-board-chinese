<?php

use App\Http\Controllers\Web\Public\DisplayHomeViewController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/'], function () {
    Route::get('/', [DisplayHomeViewController::class, 'handle'])->name('public.home.display-home-page');
});
