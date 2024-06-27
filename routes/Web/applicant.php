<?php

use App\Http\Controllers\Web\Applicant\Onboarding\DisplayOnboardingViewController;
use App\Http\Controllers\Web\Applicant\Onboarding\ProcessApplicantRegistrationController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'register'], function() {
    Route::get('/', [DisplayOnboardingViewController::class, 'handle'])->name('applicant.register.display-register-form');
    Route::post('/', [ProcessApplicantRegistrationController::class, 'handle'])->name('applicant.register.process-register-form');
});
