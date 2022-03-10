<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Session;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $portal = explode("/",$request->path());
            if (strlen($request->path()) <= 1){
                return route('student.login');
            }
            if ($portal[0] === "student")
            {
                return route('student.login');
            }
            return route('login');
        }
    }
}
