<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class UserMiddleware
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
        // $role_id = Auth::user()->vaitro_id;
        // //Lay route name tu link
        // $routeName = Route::currentRouteName();
        // $routeName = explode('.', $routeName);
        // $routeName = $routeName[0];

        // $route = DB::table('quyen')->where('tenquyen', $routeName)->get();

        // if ($role_id == 1) {
        //     return $next($request);
        // } else {
        //     if ($route->count() > 0) {
        //         $quyen = $route->first();
        //         if ($quyen->them == 1) {
        //             return $next($request);
        //         }
        //     }
        // }

        // return $next($request);

        if (Auth::check()) {
            $user = Auth::user();
            // if ($user->vaitro_id == 1) {
            //     return $next($request);
            // }
            $route = Route::currentRouteName();
            $route = explode('.', $route);
            $route = $route[0];
            $quyen = DB::table('quyen')->where('tenquyen', $route)->first();
            if ($quyen) {
                $quyen = DB::table('vaitro_quyen')->where('quyen_id', $quyen->id)->where('vaitro_id', $user->vaitro_id)->first();
                if ($quyen) {
                    return $next($request);
                } 
                else {
                    return response()->json([
                        'message' => 'Bạn không có quyền truy cập.'
                    ], 403);
                }
            }
        }

        return $next($request);
    }
}
