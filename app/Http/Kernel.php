<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
   
    /**
     * O conjunto de middlewares de rotas do aplicativo.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'admin' => \app\Http\Middleware\AdminMiddleware::class,
        'web' => \App\Http\Middleware\WebMiddleware::class,  
        'role' => \App\Http\Middleware\CheckUserRole::class,
    ];
}
