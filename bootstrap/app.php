<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectTo(
            guests: '/cms-login',
            users: '/panel-umkm'
        );
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
        $exceptions->respond(function (Response $response, Throwable $exception, Request $request) {
            // For contact form rate limiting: redirect back with friendly error
            if ($response->getStatusCode() === 429 && $request->is('contact') && $request->isMethod('POST')) {
                $retryAfter = $response->headers->get('Retry-After', 600);
                $minutes    = max(1, (int) ceil((int) $retryAfter / 60));
                return redirect()->route('contact')
                    ->withErrors([
                        'too_many_requests' => "Terlalu banyak pengiriman pesan. Silakan coba lagi dalam {$minutes} menit.",
                    ])
                    ->withInput($request->except('captcha'));
            }

            if (in_array($response->getStatusCode(), [404, 429])) {
                return Inertia::render('Error', [
                    'status' => $response->getStatusCode(),
                ])
                ->toResponse($request)
                ->setStatusCode($response->getStatusCode());
            }
            return $response;
        });
    })->create();

$app->usePublicPath(is_dir(dirname(__DIR__, 2) . '/public_html')
    ? dirname(__DIR__, 2) . '/public_html'
    : dirname(__DIR__) . '/public');

return $app;
