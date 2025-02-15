<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (in_array('auth:web', $request->route()->middleware())) {
                return route('admin.auth.login');
            }
            if (in_array('auth:manager', $request->route()->middleware())) {
                return route('manager.auth.login');
            }
            if (in_array('auth:employee', $request->route()->middleware())) {
                return route('employee.auth.login');
            }
        }
    }
}
