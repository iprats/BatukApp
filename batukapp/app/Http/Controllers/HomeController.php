<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        //Aqui carregara la quadricula del menu

        //Carregar Events

        //Carregar Temes de la Banda // Que passa si te mes bandes?

        //Carregara una vista rapida de les seves dades
        $user = session()->get("user");


        //Carregara una vista rapida de la pagina de comunitat





        return view("home", compact("user"));
    }


    /**
     * Display a listing of the resource.
     */
    public function calendari()
    {
        //Aqui carregara el calendari

        return view("calendari");
    }

    /**
     * Display a listing of the resource.
     */
    public function temes()
    {
        //Aqui carregara els temes

        return view("temes");
    }


    /**
     * Display a listing of the resource.
     */
    public function perfil()
    {
        $user = session()->get('user');

        $bandes = [];
        
        if(isset($user->bands) && count($user->bands) > 0)
        {
            
            foreach($user->bands as $key => $band)
            {
                $band->editor = false;
                $band->email = $band->email;
                $band->name = $band->name;
                $band->profile_photo = $band->profile_photo;
    
                if($band->role == "Editor")
                {
                    $band->editor = true;
                    $band->nif = $band->nif;
    
                    $band->members = ApiController::callApi("/users/band/" . $band->idband);

                }
    
                $band->instruments = [];//ApiController::callApi("/")                  //Agafar instruments que toco a la band
    
                $user->bands[$key] = $band;
            }
        }
        
        return view("perfil.show", compact("user"));
    }


    /**
     * Display a listing of the resource.
     */
    public function perfilEdit(Request $request)
    {
        $user = session()->get('user');

        return view("perfil.edit", compact("user"));
    }


    /**
     * Display a listing of the resource.
     */
    public function perfilSave(Request $request)
    {
        $user = session()->get('user');


        $editUser = new \stdClass();    //Aquest es l'objecte que enviare a l'API perque modifiqui la base de dades
        $updatedUser = $user;           //I aquest objecte es per mantenir els canvis a la session 

            
        if(isset($request->name))
        {
            $editUser->name = $request->name;
            $updatedUser->name = $editUser->name;
        }
        
        if(isset($request->dni))
        {
            $editUser->dni = $request->dni;
            $updatedUser->dni = $editUser->dni;
        }
        
        if(isset($request->birth_date))
        {
            $editUser->birth_date = $request->birth_date;
            $updatedUser->birth_date = $editUser->birth_date;
        }
        
        if(isset($request->profile_photo))
        {
            //Base64
            //dd($request->file('profile_photo'), "hola");


            
            // $type = pathinfo($request->profile_photo->path(), PATHINFO_BASENAME);
            
            // $data = file_get_contents($request->profile_photo->path());
            // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            // dd($base64, $type, $data);


            // $image = "data:" . $request->profile_photo . ";base64,".base64_encode(file_get_contents($request->profile_photo->path()));
            // dd($image);

            
            $editUser->profile_photo = $request->profile_photo;
            $updatedUser->profile_photo = $editUser->profile_photo;

        }

        $ok = ApiController::callApi("/users/" . $user->google_id, true, "PUT", $editUser);
        
        if($ok)
        {
            $user = $updatedUser;
    
            session(["google_id" => $user->google_id, "user" => $user]);
            
    
            return $this->perfil();
        }
        else
        {
            $user->error = "No s'ha pogut actualitzar l'usuari";

            return view("perfil.edit", compact("user"));
        }

    }


    /**
     * Display a listing of the resource.
     */
    public function bandaEdit(int $key)
    {
        $user = session()->get('user');
        
        $banda = $user->bands[$key];

        $banda->members = ApiController::callApi("/users/band/" . $banda->idband);
        foreach($banda->members as $key => $membre)
        {
            $ids_instruments = [];
            foreach($membre->instruments as $inst)
            {
                $ids_instruments[] = $inst->idinstrument;
            }
            $banda->members[$key]->ids_instruments = $ids_instruments;
        }

        $instruments = ApiController::callApi("/instruments/" . $banda->idband);


        //dd($banda, $instruments);
        
        return view("perfil.editBanda", compact("banda", "key", "instruments", "user"));
    }


    /**
     * Display a listing of the resource.
     */
    public function bandaSave(Request $request)
    {

        // dd($request);
        // $user = session()->get('user');


        // $editBand = new \stdClass();    //Aquest es l'objecte que enviare a l'API perque modifiqui la base de dades
        // $updatedBand = $user->bands[0]; //I aquest objecte es per mantenir els canvis a la session 

            
        // if(isset($request->name))
        // {
        //     $editUser->name = $request->name;
        //     $updatedUser->name = $editUser->name;
        // }
        
        // if(isset($request->nif))
        // {
        //     $editUser->nif = $request->nif;
        //     $updatedUser->nif = $editUser->nif;
        // }
        
        // if(isset($request->birth_date))
        // {
        //     $editUser->birth_date = $request->birth_date;
        //     $updatedUser->birth_date = $editUser->birth_date;
        // }
        
        // if(isset($request->profile_photo))
        // {
        //     $editUser->profile_photo = $request->profile_photo;
        //     $updatedUser->profile_photo = $editUser->profile_photo;
        // }

        // $ok = ApiController::callApi("/users/" . $user->google_id, true, "PUT", $editUser);
        
        // if($ok)
        // {
        //     $user = $updatedUser;
    
        //     session(["google_id" => $user->google_id, "user" => $user]);
            
    
        //     return $this->perfil();
        // }
        // else
        // {
        //     $user->error = "No s'ha pogut actualitzar l'usuari";

        //     return view("perfil.edit", compact("user"));
        // }

    }

    
    /**
     * Display a listing of the resource.
     */
    public function comunitat()
    {
        //Aqui carregara la comunitat

        //Aqui carrego els propers events

        return view("comunitat");
    }
}