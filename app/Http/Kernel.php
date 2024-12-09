<?php
protected $routeMiddleware = [
    // Other middleware
    'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
];