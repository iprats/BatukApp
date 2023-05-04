<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function home()
    {
        //Aqui carregara la quadricula del menu

        //Carregar Events

        //Carregar Temes de la Banda // Que passa si te mes bandes?

        //Carregara una vista rapida de les seves dades

        //Carregara una vista rapida de la pagina de comunitat





        return view("home");
    }


    /**
     * Display a listing of the resource.
     */
    public static function calendari()
    {
        //Aqui carregara el calendari

        return view("calendari");
    }

    /**
     * Display a listing of the resource.
     */
    public static function temes()
    {
        //Aqui carregara els temes

        return view("temes");
    }


    /**
     * Display a listing of the resource.
     */
    public static function perfil()
    {
        $user = session()->get('user');
        $bandes = [];
        
        foreach($user->bands as $band)
        {
            $banda = new \stdClass();

            $banda->editor = false;
            $banda->email = $band->email;
            $banda->name = $band->name;
            $banda->profile_photo = $band->profile_photo;

            if($band->role == "Editor")
            {
                $banda->editor = true;
                $banda->nif = $band->nif;

                $banda->members = ApiController::callApi("/users/band/" . $band->idband);

            }

            $banda->instruments = [];//ApiController::callApi("/")                  //Agafar instruments que toco a la banda

            $bandes[] = $banda;
        }





        
        return view("perfil.show", compact("user", "bandes"));
    }


    /**
     * Display a listing of the resource.
     */
    public static function perfilEdit(Request $request)
    {
        $user = session()->get('user');

        return view("perfil.edit", compact("user"));
    }


    /**
     * Display a listing of the resource.
     */
    public static function perfilSave(Request $request)
    {
        $user = session()->get('user');

        $editUser = new \stdClass();

        $editUser->name = $request->name;
        $editUser->dni = $request->dni;
        $editUser->birth_date = $request->birth_date;
        $editUser->profile_photo = $request->profile_photo;
        $editUser->google_id = $user->google_id;

        //dd($editUser);
        $ok = callApi("/users", true, "PUT", $editUser);

        if($ok)
        {

            $user->name = $request->name;
            $user->dni = $request->dni;
            $user->birth_date = $request->birth_date;
            $user->profile_photo = $request->profile_photo;
    
            session(["google_id" => $user->google_id, "user" => $user]);
        }
        else
        {
            $error = "No s'ha pogut actualitzar l'usuari";
        }
    
        return view("perfil.edit", compact("user", "error"));

    }


    /**
     * Display a listing of the resource.
     */
    public static function bandaEdit(int $key)
    {
        $user = session()->get('user');
        
        $banda = $user->bands[$key];

        //dd($banda);

        //AGAFAR UNA BANDA
        
        return view("perfil.editBanda", compact("banda"));
    }

    
    /**
     * Display a listing of the resource.
     */
    public static function comunitat()
    {
        //Aqui carregara la comunitat

        return view("comunitat");
    }
}