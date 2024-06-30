<?php

use App\Http\Middleware\Web\EnforceApplicantAccountVerification;
use App\Http\Middleware\Web\EnforceApplicationPayment;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'enforceApplicantAccountVerification' => EnforceApplicantAccountVerification::class,
            'enforceApplicationPayment' => EnforceApplicationPayment::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
