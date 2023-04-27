<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $google_id = null;

        if(isset($_COOKIE["google_id"]))
        {
            $google_id = $_COOKIE["google_id"];
        }

        if($request->session()->has("google_id") && $google_id)
        {
            $expires = time() + 3600 * 24 * 365;
            setcookie("google_id", $request->session()->get("google_id"), $expires);
        }
        else
        {
            dd($google_id);
            return redirect("/");
        }


        return $next($request);
    }
}
