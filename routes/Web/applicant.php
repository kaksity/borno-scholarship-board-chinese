<?php

use App\Http\Controllers\Web\Applicant\ApplicationPayment\DisplayApplicationPaymentViewController;
use App\Http\Controllers\Web\Applicant\AccountVerification\ProcessRequestAccountVerificationController;
use App\Http\Controllers\Web\Applicant\AccountVerification\ProcessVerifyAccountVerificationController;
use App\Http\Controllers\Web\Applicant\ApplicationPayment\ProcessApplicationPaymentController;
use App\Http\Controllers\Web\Applicant\ApplicationProcessing\DisplayApplicationProcessingViewController;
use App\Http\Controllers\Web\Applicant\ApplicationProcessing\DisplayPreviewApplicationProcessingViewController;
use App\Http\Controllers\Web\Applicant\ApplicationProcessing\ProcessApplicationProcessingController;
use App\Http\Controllers\Web\Applicant\ApplicationProcessing\ProcessDeleteApplicationProcessingController;
use App\Http\Controllers\Web\Applicant\ApplicationProcessing\ProcessSubmitApplicationProcessingController;
use App\Http\Controllers\Web\Applicant\Onboarding\DisplayOnboardingViewController;
use App\Http\Controllers\Web\Applicant\Onboarding\ProcessApplicantRegistrationController;
use App\Http\Controllers\Web\Applicant\Authentication\DisplayLoginViewController;
use App\Http\Controllers\Web\Applicant\Authentication\ProcessApplicantLoginController;
use App\Http\Controllers\Web\Applicant\Authentication\ProcessApplicantLogoutController;
use App\Http\Controllers\Web\Applicant\Dashboard\DisplayDashboardViewController;
use App\Http\Controllers\Web\Applicant\PassportManagement\DisplayPassportViewController;
use App\Http\Controllers\Web\Applicant\PassportManagement\ProcessUploadPassportController;
use App\Http\Controllers\Web\Applicant\PasswordManagement\ChangePassword\DisplayChangePasswordViewController;
use App\Http\Controllers\Web\Applicant\PasswordManagement\ChangePassword\ProcessChangePasswordController;
use App\Http\Controllers\Web\Applicant\PasswordManagement\ResetPassword\DisplayResetPasswordViewController;
use App\Http\Controllers\Web\Applicant\PasswordManagement\ResetPassword\ProcessResetPasswordController;
use App\Http\Controllers\Web\Applicant\ProfileManagement\DisplayProfileViewController;
use App\Http\Controllers\Web\Applicant\ProfileManagement\ProcessUpdateProfileController;
use App\Http\Controllers\Web\Applicant\UploadManagement\DisplayUploadDocumentViewController;
use App\Http\Controllers\Web\Applicant\UploadManagement\ProcessUploadDocumentController;
use App\Http\Controllers\Web\Applicant\UploadManagement\ProcessDeleteUploadedDocumentController;
use App\Http\Middleware\Web\EnforceApplicantAccountVerification;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'register'], function() {
    Route::get('/', [DisplayOnboardingViewController::class, 'handle'])->name('applicant.register.display-register-form');
    Route::post('/', [ProcessApplicantRegistrationController::class, 'handle'])->name('applicant.register.process-register-form');
});

Route::group(['prefix' => 'authentication'], function () {
    Route::get('/login', [DisplayLoginViewController::class, 'handle'])->name('applicant.authentication.login.display-login-form');
    Route::post('/login', [ProcessApplicantLoginController::class, 'handle'])->name('applicant.authentication.login.process-login-form');
    Route::post('/logout', [ProcessApplicantLogoutController::class, 'handle'])->name('applicant.authentication.login.process-logout-form')->middleware('auth:applicant');;
});

Route::group(['prefix' => 'reset-password'], function() {
    Route::get('/', [DisplayResetPasswordViewController::class, 'handle'])->name('applicant.reset-password.display-reset-password-form');
    Route::post('/', [ProcessResetPasswordController::class, 'handle'])->name('applicant.reset-password.process-reset-password-form');
});

Route::group(['middleware' => ['auth:applicant']], function() {
    Route::group(['middleware' => [ 'enforceApplicantAccountVerification', 'enforceApplicationPayment']], function() {
        Route::group(['prefix' => 'profile-management'], function() {
            Route::get('/', [DisplayProfileViewController::class, 'handle'])->name('applicant.profile-management.display-profile-form');
            Route::post('/', [ProcessUpdateProfileController::class, 'handle'])->name('applicant.profile-management.process-profile-form');
        });

        Route::group(['prefix' => 'passport-management'], function() {
            Route::get('/', [DisplayPassportViewController::class, 'handle'])->name('applicant.passport-management.display-passport-form');
            Route::post('/', [ProcessUploadPassportController::class, 'handle'])->name('applicant.passport-management.process-upload-passport-form');
        });

        Route::group(['prefix' => 'upload-management'], function() {
            Route::get('/', [DisplayUploadDocumentViewController::class, 'handle'])->name('applicant.upload-management.display-upload-document-form');
            Route::post('/', [ProcessUploadDocumentController::class, 'handle'])->name('applicant.upload-management.process-upload-document-form');
            Route::delete('/{id}', [ProcessDeleteUploadedDocumentController::class, 'handle'])->name('applicant.upload-management.process-delete-uploaded-document');
        });

        Route::group(['prefix' => 'application-processing'], function() {
            Route::get('/', [DisplayApplicationProcessingViewController::class, 'handle'])->name('applicant.application-processing.display-application-processing-form');
            Route::post('/', [ProcessApplicationProcessingController::class, 'handle'])->name('applicant.application-processing.process-application-processing-form');
            Route::get('/preview', [DisplayPreviewApplicationProcessingViewController::class, 'handle'])->name('applicant.application-processing.display-preview-application-processing-form');
            Route::post('/submit', [ProcessSubmitApplicationProcessingController::class, 'handle'])->name('applicant.application-processing.process-submit-application-processing-form');
            Route::delete('/{id}', [ProcessDeleteApplicationProcessingController::class, 'handle'])->name('applicant.application-processing.process-delete-application-processing');
        });

        Route::group(['prefix' => 'change-password'], function() {
            Route::get('/', [DisplayChangePasswordViewController::class, 'handle'])->name('applicant.change-password.display-change-password-form');
            Route::post('/', [ProcessChangePasswordController::class, 'handle'])->name('applicant.change-password.process-change-password-form');
        });
    });

    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/', [DisplayDashboardViewController::class, 'handle'])->name('applicant.dashboard.display-dashboard-view');
    });

    Route::group(['prefix' => 'account-verification'], function() {
        Route::post('/request', [ProcessRequestAccountVerificationController::class, 'handle'])->name('applicant.account-verification.process-request-account-verification-mail');
        Route::get('/verify/{id}', [ProcessVerifyAccountVerificationController::class, 'handle'])->name('applicant.account-verification.process-verify-account-verification-mail')->withoutMiddleware('enforceApplicantAccountVerification');
    });

    Route::group(['prefix' => 'application-payment'], function() {
        Route::get('/', [DisplayApplicationPaymentViewController::class, 'handle'])->name('applicant.application-payment.display-application-payment');
        Route::post('/', [ProcessApplicationPaymentController::class, 'handle'])->name('applicant.application-payment.process-application-payment');
    });
})->middleware(EnforceApplicantAccountVerification::class);
