<?php

use App\Http\Controllers\Web\Applicant\Onboarding\DisplayOnboardingViewController;
use App\Http\Controllers\Web\Applicant\Onboarding\ProcessApplicantRegistrationController;
use App\Http\Controllers\Web\Applicant\Authentication\DisplayLoginViewController;
use App\Http\Controllers\Web\Applicant\Authentication\ProcessApplicantLoginController;
use App\Http\Controllers\Web\Applicant\Authentication\ProcessApplicantLogoutController;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'register'], function() {
    Route::get('/', [DisplayOnboardingViewController::class, 'handle'])->name('applicant.register.display-register-form');
    Route::post('/', [ProcessApplicantRegistrationController::class, 'handle'])->name('applicant.register.process-register-form');
});

Route::group(['prefix' => 'authentication'], function () {
    Route::get('/login', [DisplayLoginViewController::class, 'handle'])->name('applicant.authentication.login.display-login-form');
    Route::post('/login', [ProcessApplicantLoginController::class, 'handle'])->name('applicant.authentication.login.process-login-form');
    Route::post('/logout', [ProcessApplicantLogoutController::class, 'handle'])->name('applicant.authentication.login.process-logout-form');
});
