<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/login',
        '/auth',
        '/ask',
        '/admin',
        '/admin/users',
        '/admin/users/{id}/edit',
        '/admin/users/{id}',
        '/admin/users/*',
        '/admin/answer/add',
        '/admin/answer/manage',
        '/admin/categories',
        '/admin/answer/category',
        '/admin/answer/hided'
    ];
}
