<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
        /**
        * Stateful APIs rely on server-side storage to maintain client state. 
        * This can include databases or in-memory storage for session data. 
        * Stateless APIs do not have a server-side storage dependency for the client states, 
        * making them easier to scale horizontally without the need for a shared state among server instances.
        **/
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
