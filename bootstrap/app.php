<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\Mailer\Exception\TransportException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, $request) {
            /**
             * Handling Validation Exception.
             */
            if ($e instanceof ValidationException) {
                if ($request->ajax()) {
                    /**
                     * Handling Authorization Validation.
                     */

                    /**
                     * Fallback Handling for Other Validation.
                     */
                    return response()->json([
                        'message' => $e->getMessage(),
                        'errors' => collect($e->errors())->unique()->toArray(),
                    ], 422);
                }

                return redirect()->back()->withErrors($e->errors());
            }

            /**
             * Handling Transport (Notification) Exception.
             */
            if ($e instanceof TransportException) {
                if ($request->ajax()) {
                    return response()->json([
                        'message' => 'Email host belum diatur.',
                    ], 500);
                }
                if (!$request->routeIs('error.page.preview')) {
                    return redirect()->route('error.page.preview', 500);
                }
            }


            redirect()->back()->with('error', $e->getMessage());
        });

    })->create();
