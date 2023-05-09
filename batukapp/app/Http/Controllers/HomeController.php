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

        //Carregara una vista rapida del perfil

        $user = session()->get("user");
        //Aqui carregara la quadricula del menu

        //Carregar Events

        $date = getdate(time());
        $any = $date["year"];
        $mes = $date["mon"];

        $eventsCalendari = [];

        if(isset($user->idband))
        {
            $eventsCalendari = ApiController::callApi("/events/year/$any/month/$mes?idband=". $user->idband);
        }
        elseif(isset($user->iduser))
        {
            $eventsCalendari = ApiController::callApi("/events/year/$any/month/$mes?iduser=". $user->iduser);
        }
        $eventsCalendari = json_decode('[{"idevent":1,"name":"Futbol Sala GIrona","description":"Anima al girona","location":"Estadi del girona","datetime":"2023-05-14T15:45:00.000Z","private":false,"status":"Per confirmar","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[{"idassistance":2,"answer":"Pendent","instrument":{"idinstrument":4,"name":"Caixa","sound_file_or_url":null},"user":{"iduser":3,"name":"Lluc Oliveras","email":"a","dni":null,"google_id":"1","birth_date":"1970-01-01","profile_photo":null}},{"idassistance":1,"answer":"Si + Transport","instrument":{"idinstrument":1,"name":"Repenique","sound_file_or_url":null},"user":{"iduser":1,"name":"Isaac Master","email":"soclisaac@gmail.com","dni":"41634247S","google_id":"114970352960464205366","birth_date":"2000-09-26","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/users/isaac_prats_renart_foto.png"}}]},{"idevent":3,"name":"Event 1","description":"Descripcio","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","datetime":"2023-05-30T18:00:00.000Z","private":false,"status":"Anulat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]},{"idevent":5,"name":"Event 3","description":"Descripcio","location":"Algun lloc","datetime":"2023-06-02T18:00:00.000Z","private":false,"status":"Confirmat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]}]');

        //Carregar Temes de la Banda // Que passa si te mes bandes?
        
        $temes = ["Tema 1","Tema 2","Tema 3","Tema 4"];

        //Carregara una vista rapida de la pagina de comunitat

        $dia = $date["mday"];
        
        $eventsComunitat = ApiController::callApi("/events/year/$any/month/$mes?day=$dia");

        $eventsComunitat = json_decode('[{"idevent":1,"name":"Futbol Sala GIrona","description":"Anima al girona","location":"Estadi del girona","datetime":"2023-05-14T15:45:00.000Z","private":false,"status":"Per confirmar","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[{"idassistance":2,"answer":"Pendent","instrument":{"idinstrument":4,"name":"Caixa","sound_file_or_url":null},"user":{"iduser":3,"name":"Lluc Oliveras","email":"a","dni":null,"google_id":"1","birth_date":"1970-01-01","profile_photo":null}},{"idassistance":1,"answer":"Si + Transport","instrument":{"idinstrument":1,"name":"Repenique","sound_file_or_url":null},"user":{"iduser":1,"name":"Isaac Master","email":"soclisaac@gmail.com","dni":"41634247S","google_id":"114970352960464205366","birth_date":"2000-09-26","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/users/isaac_prats_renart_foto.png"}}]},{"idevent":3,"name":"Event 1","description":"Descripcio","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","datetime":"2023-05-30T18:00:00.000Z","private":false,"status":"Anulat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]},{"idevent":5,"name":"Event 3","description":"Descripcio","location":"Algun lloc","datetime":"2023-06-02T18:00:00.000Z","private":false,"status":"Confirmat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]}]');


        if(isset($eventsCalendari))
        {
            foreach($eventsCalendari as $i => $events)
            {
                $date = new \DateTime($events->datetime);            

                $dia = $date->format("d/m/Y");
                $hora = $date->format("H:i");

                $eventsCalendari[$i]->hora = $hora;
                $eventsCalendari[$i]->dia = $dia;
            }
        }

        foreach($eventsComunitat as $i => $events)
        {
            $date = new \DateTime($events->datetime);            

            $dia = $date->format("d/m/Y");
            $hora = $date->format("H:i");

            $eventsComunitat[$i]->hora = $hora;
            $eventsComunitat[$i]->dia = $dia;
        }


        //dd($user, $eventsCalendari, $eventsComunitat, $temes);

        return view("home", compact("user", "eventsCalendari", "eventsComunitat", "temes"));
    }


    /**
     * Display a listing of the resource.
     */
    public function calendari()
    {
        //Aqui carregara el calendari
        $user = session()->get("user");

        $date = getdate(time());
        $mes = $date["mon"];
        $any = $date["year"];

        if(isset($user->idband))
        {
            $events = ApiController::callApi("/events/month/$mes/year/$any?idband=". $user->idband);
        }
        else
        {
            $events = ApiController::callApi("/events/month/$mes/year/$any?iduser=". $user->iduser);
        }
        $events = json_decode('[{"idevent":1,"name":"Futbol Sala GIrona","description":"Anima al girona","location":"Estadi del girona","datetime":"2023-05-14T15:45:00.000Z","private":false,"status":"Per confirmar","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[{"idassistance":2,"answer":"Pendent","instrument":{"idinstrument":4,"name":"Caixa","sound_file_or_url":null},"user":{"iduser":3,"name":"Lluc Oliveras","email":"a","dni":null,"google_id":"1","birth_date":"1970-01-01","profile_photo":null}},{"idassistance":1,"answer":"Si + Transport","instrument":{"idinstrument":1,"name":"Repenique","sound_file_or_url":null},"user":{"iduser":1,"name":"Isaac Master","email":"soclisaac@gmail.com","dni":"41634247S","google_id":"114970352960464205366","birth_date":"2000-09-26","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/users/isaac_prats_renart_foto.png"}}]},{"idevent":3,"name":"Event 1","description":"Descripcio","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","datetime":"2023-05-30T18:00:00.000Z","private":false,"status":"Anulat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]},{"idevent":5,"name":"Event 3","description":"Descripcio","location":"Algun lloc","datetime":"2023-06-02T18:00:00.000Z","private":false,"status":"Confirmat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]}]');

        //dd($events);


        return view("calendari", compact("events"));
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
    public function bandaEdit($key)
    {
        $user = session()->get('user');

        if(isset($user->iduser))
        {
            $banda = $user->bands[$key];
        }
        else
        {
            $banda = $user;
        }
        

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

        $user = session()->get('user');

        if(isset($user->idband))
        {
            $band = $user;
        }
        else
        {
            $trobat = false;
            $i = 0;
            while(!$trobat && $i < count($user->bands))
            {
                if($request->idband == $user->bands[$i]->idband)
                {
                    $trobat == !$trobat;
                    $band = $user->bands[$i];
                }
            }
        }



        $editBand = new \stdClass();    //Aquest es l'objecte que enviare a l'API perque modifiqui la base de dades
        $updatedBand = $band; //I aquest objecte es per mantenir els canvis a la session 

            
        if(isset($request->name))
        {
            $editBand->name = $request->name;
            $updatedBand->name = $editBand->name;
        }
        
        if(isset($request->nif))
        {
            $editBand->nif = $request->nif;
            $updatedBand->nif = $editBand->nif;
        }
        
        if(isset($request->location))
        {
            $editBand->location = $request->location;
            $updatedBand->location = $editBand->location;
        }
        
        //banda ->Info Banda //Que es el que ja esta fet aqui sobre

        $membres = [];

        foreach($request->instruments as $id => $ins)
        {
            $instruments = explode(",", $ins);            
            $userBand = ["iduser" => $id, "role" => $request->rol[$id], "instruments" => $instruments];
            
            $membres[] = $userBand;
        }


        $editBand->users = $membres;


        dd($band, $editBand, $updatedBand, $request);


        //      ->Membres->[iduser, rol, [idinstrument,idinstrument]]

        $ok = ApiController::callApi("/bands/" . $band->idband, true, "PUT", $editBand);



        if($ok)
        {
            $user = $updatedBand;
    
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
    public function comunitat()
    {
        $user = session()->get("user");

        //Aqui carregara la comunitat

        //Aqui carrego els propers events

        $date = getdate(time());
        $dia = $date["mday"];
        $mes = $date["mon"];
        $any = $date["year"];
        
        $events = ApiController::callApi("/events/year/$any/month/$mes?day=$dia");

        return view("comunitat", compact("user"));
    }
}