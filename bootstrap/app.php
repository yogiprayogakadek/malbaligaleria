<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\TrackVisitors::class,
            \App\Http\Middleware\CheckMaintenanceMode::class,
        ]);

        $middleware->alias([
            'checkUserStatus'        => \App\Http\Middleware\CheckUserStatus::class,
            'role'                   => \App\Http\Middleware\CheckRole::class,
            'superuser'              => \App\Http\Middleware\SuperUserMiddleware::class,
            'permission'             => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'check_inventory_access' => \App\Http\Middleware\CheckInventoryAccess::class,
            'check_inventory_ip'     => \App\Http\Middleware\CheckInventoryIpWhitelist::class,
        ]);

        $middleware->redirectGuestsTo(function (\Illuminate\Http\Request $request) {
            if ($request->getHost() === config('inventory.subdomain', 'inventory.malbaligaleria.com')) {
                return route('inventory.login');
            }
            return route('login');
        });

        $middleware->redirectUsersTo(function (\Illuminate\Http\Request $request) {
            if ($request->getHost() === config('inventory.subdomain', 'inventory.malbaligaleria.com')) {
                return route('inventory.index');
            }
            return '/dashboard';
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
