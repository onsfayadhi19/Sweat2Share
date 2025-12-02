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
        $middleware->alias([
            'Admin' => \App\Http\Middleware\Admin::class,
            'citizen' => \App\Http\Middleware\Citizen::class,
            'Partner' => \App\Http\Middleware\Partner::class,
            'Coach' => \App\Http\Middleware\Coach::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();