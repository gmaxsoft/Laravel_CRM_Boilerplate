<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ThrottleRequestsException $e, \Illuminate\Http\Request $request) {
            if ($request->is('login') || $request->routeIs('login')) {
                $seconds = $e->getHeaders()['Retry-After'] ?? 60;

                return back()->withErrors([
                    'email' => module_trans('Auth', 'auth.throttle', ['seconds' => $seconds]),
                ])->withInput($request->only('email'));
            }
        });
    })->create();
