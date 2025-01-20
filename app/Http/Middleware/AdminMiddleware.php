<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role_id == 2) {
            return $next($request); // Admin kullanıcı, admin paneline yönlendirilir
        }
        return redirect()->route('admin.login')->with('error', 'Yetkiniz yok!'); // Yetkisi olmayanları login sayfasına yönlendirilir
        
    }
}
