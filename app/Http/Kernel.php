<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as BaseKernel;
use Illuminate\Foundation\Configuration\Middleware;

class Kernel extends BaseKernel
{
    protected function middleware(): array
    {
        return [
            // Global middleware (if any)
        ];
    }

    protected function middlewareGroups(): array
    {
        return [
            'web' => [
                \Illuminate\Cookie\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            ],
        ];
    }
}
