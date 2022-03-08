<?php

namespace App\Http\Middleware;

use App\Http\Service\ToastMessageServices;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->type !== "student") {
            return redirect()->back()->with(ToastMessageServices::generateMessage('Not Allowed', false));
        }
        return $next($request);
    }
}
