<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyselfMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        foreach (self::$parameterKeys as $key) {
            if (array_key_exists($key, $request->route()->parameters())) {
                $parameter_value = $request->route()->parameters()[$key];
                $parameter_key = $key;
            }
        }

        if ($parameter_value != Auth::user()->$parameter_key) {
            if (preg_match('/admin/', $parameter_key)) {
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('home');
            }
        }
        return $next($request);
    }

    /**
     * URLパラメーターのリスト
     */
    private static $parameterKeys = [
        'user_name',
        'admin_name',
    ];
}