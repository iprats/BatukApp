<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public static function googleCallback()
    {
        $user_google = Socialite::driver('google')->stateless()->user();
        $user = ApiController::callApi("/users", true, "POST", $user_google);


        session_start();
        session(["google_id" => $user->google_id, "user" => $user]);

        if(isset($user->bands) && count($user->bands) > 0)
        {
            return redirect("/home");
        }
        else
        {
            return redirect("/comunitat");
        }
    }

    public static function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if(isset($_COOKIE["google_id"]))
        {
            $_COOKIE["google_id"] = null;
        }

        return redirect("/comunitat");
    }
}