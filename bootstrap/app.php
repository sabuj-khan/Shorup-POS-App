<?php

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
        $middleware->validateCsrfTokens(except: [
        'http://127.0.0.1:8000/user-registration',
        'http://127.0.0.1:8000/user-login',
        'http://127.0.0.1:8000/send-otp',
        'http://127.0.0.1:8000/verify-otp',
        'http://127.0.0.1:8000/reset-password',
        'http://127.0.0.1:8000/user-profile-update',
        'http://127.0.0.1:8000/category-create',
        'http://127.0.0.1:8000/category-update',
        'http://127.0.0.1:8000/category-delete',
        'http://127.0.0.1:8000/category-by-id',
        'http://127.0.0.1:8000/customers-create',
        'http://127.0.0.1:8000/customers-update',
        'http://127.0.0.1:8000/customers-delete',
        'http://127.0.0.1:8000/customers-by-id',
        'http://127.0.0.1:8000/product-create',
        'http://127.0.0.1:8000/product-update',
        'http://127.0.0.1:8000/product-delete',
        'http://127.0.0.1:8000/product-by-id',
        'http://127.0.0.1:8000/invoice-create',
        'http://127.0.0.1:8000/invoice-details',
        'http://127.0.0.1:8000/invoice-delete',

        
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
