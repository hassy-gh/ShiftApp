<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JoinMiddleware
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
        $group_name = $request->route()->parameter('group_name');
        $groups = Auth::user()->groups;

        if (is_null($groups->where('group_name', $group_name)->first())) {
            if (Auth::user()->admin_name) {
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('home');
            }
        }
        return $next($request);
    }
}