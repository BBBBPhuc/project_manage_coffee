<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class WebClientMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $check =  Auth::guard('client')->check();
        if (!$check) {
            toastr()->error("Yêu Cầu Phải Đăng Nhập Tài Khoản!");
            return redirect("/login&register");
        }
        return $next($request);
    }
}
