<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$basePath = dirname(__DIR__);

$app = Application::configure(basePath: $basePath)
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\SetLocaleFromSession::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

// На проде проект деплоится в подпапку (например /www), доступную веб-серверу.
// Если .env лежит на уровень выше — вне веб-рута — используем его. Если нет
// (локальная разработка), Laravel по умолчанию берёт .env из корня проекта.
$externalEnvPath = dirname($basePath);

if (is_file($externalEnvPath.DIRECTORY_SEPARATOR.'.env')) {
    $app->useEnvironmentPath($externalEnvPath);
}

return $app;
