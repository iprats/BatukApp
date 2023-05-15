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
        
        $utc = session()->get("utc");


        if(isset($user->idband))
        {
            $eventsCalendari = ApiController::callApi("/events/calendar?idband=". $user->idband . "&utc=$utc");
        }
        elseif(isset($user->iduser))
        {
            $eventsCalendari = ApiController::callApi("/events/calendar?iduser=". $user->iduser . "&utc=$utc");
        }
        //hardcode
        //$eventsCalendari = json_decode('[{"idevent":1,"name":"Futbol Sala GIrona","description":"Anima al girona","location":"Estadi del girona","start_date":"2023-05-14T15:45:00.000Z","private":false,"status":"Per confirmar","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[{"idassistance":2,"answer":"Pendent","instrument":{"idinstrument":4,"name":"Caixa","sound_file_or_url":null},"user":{"iduser":3,"name":"Lluc Oliveras","email":"a","dni":null,"google_id":"1","birth_date":"1970-01-01","profile_photo":null}},{"idassistance":1,"answer":"Si + Transport","instrument":{"idinstrument":1,"name":"Repenique","sound_file_or_url":null},"user":{"iduser":1,"name":"Isaac Master","email":"soclisaac@gmail.com","dni":"41634247S","google_id":"114970352960464205366","birth_date":"2000-09-26","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/users/isaac_prats_renart_foto.png"}}]},{"idevent":3,"name":"Event 1","description":"Descripcio","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","start_date":"2023-05-30T18:00:00.000Z","private":false,"status":"Anulat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]},{"idevent":5,"name":"Event 3","description":"Descripcio","location":"Algun lloc","start_date":"2023-06-02T18:00:00.000Z","private":false,"status":"Confirmat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]}]');

        //Carregar Temes de la Banda // Que passa si te mes bandes?
        
        $temes = ["Tema 1","Tema 2","Tema 3","Tema 4"];

        //Carregara una vista rapida de la pagina de comunitat

        $dia = $date["mday"];
        
        $eventsComunitat = ApiController::callApi("/events/community?utc=$utc");

        //hardcode
        //$eventsComunitat = json_decode('[{"idevent":1,"name":"Futbol Sala GIrona","description":"Anima al girona","location":"Estadi del girona","start_date":"2023-05-14T15:45:00.000Z","private":false,"status":"Per confirmar","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[{"idassistance":2,"answer":"Pendent","instrument":{"idinstrument":4,"name":"Caixa","sound_file_or_url":null},"user":{"iduser":3,"name":"Lluc Oliveras","email":"a","dni":null,"google_id":"1","birth_date":"1970-01-01","profile_photo":null}},{"idassistance":1,"answer":"Si + Transport","instrument":{"idinstrument":1,"name":"Repenique","sound_file_or_url":null},"user":{"iduser":1,"name":"Isaac Master","email":"soclisaac@gmail.com","dni":"41634247S","google_id":"114970352960464205366","birth_date":"2000-09-26","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/users/isaac_prats_renart_foto.png"}}]},{"idevent":2,"name":"Aniversari Batukeiros 5 anys","description":"Parida festassa","location":"Barracons Udg","start_date":"2023-06-21T18:00:00.000Z","private":false,"status":"Confirmat","band":{"idband":2,"name":"Batukeiros UdG","email":"","location":"Universitat de Girona","nif":null,"profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_batukeiros.png","google_id":null},"assistance":[]},{"idevent":3,"name":"Event 1","description":"Descripcio","location":"ALgun lloc","start_date":"2023-05-30T18:00:00.000Z","private":false,"status":"Anulat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]},{"idevent":4,"name":"Event 2","description":"Descripcio","location":"ALgun lloc","start_date":"2023-06-30T18:00:00.000Z","private":false,"status":"Per confirmar","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]},{"idevent":5,"name":"Event 3","description":"Descripcio","location":"ALgun lloc","start_date":"2023-06-02T18:00:00.000Z","private":false,"status":"Confirmat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]},{"idevent":6,"name":"Event 4","description":"Descripcio","location":"ALgun lloc","start_date":"2023-06-15T18:00:00.000Z","private":false,"status":"Confirmat","band":{"idband":2,"name":"Batukeiros UdG","email":"","location":"Universitat de Girona","nif":null,"profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_batukeiros.png","google_id":null},"assistance":[]},{"idevent":7,"name":"Event 5","description":"Descripcio","location":"ALgun lloc","start_date":"2023-07-03T18:00:00.000Z","private":false,"status":"Per confirmar","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]},{"idevent":8,"name":"Event 6","description":"Descripcio","location":"ALgun lloc","start_date":"2023-07-17T18:00:00.000Z","private":false,"status":"Anulat","band":{"idband":2,"name":"Batukeiros UdG","email":"","location":"Universitat de Girona","nif":null,"profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_batukeiros.png","google_id":null},"assistance":[]},{"idevent":9,"name":"Event 7","description":"Descripcio","location":"ALgun lloc","start_date":"2023-08-26T18:00:00.000Z","private":false,"status":"Confirmat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]}]');


        if(isset($eventsCalendari))
        {
            foreach($eventsCalendari as $i => $events)
            {
                $date = new \DateTime($events->start_date);            

                $dia = $date->format("d/m/Y");
                $hora = $date->format("H:i");

                $eventsCalendari[$i]->hora = $hora;
                $eventsCalendari[$i]->dia = $dia;
            }
        }

        foreach($eventsComunitat as $i => $events)
        {
            $date = new \DateTime($events->start_date);            

            $dia = $date->format("d/m/Y");
            $hora = $date->format("H:i");

            $eventsComunitat[$i]->hora = $hora;
            $eventsComunitat[$i]->dia = $dia;
        }


        //dd($user, $eventsCalendari, $eventsComunitat, $temes);

        return view("home", compact("user", "eventsCalendari", "eventsComunitat", "temes"));
    }


            
    public static function input_cleaner($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
      }

    public function action(Request $request)
    {
        $utc = session()->get("utc");

        if($request->type == 'add')
        {
            $event = new \stdClass();            

            $event->name = $request->name;
            $event->start_date = $request->start_date . " " . $request->start_hour;
            
            if(isset($request->end_date))
            {
                $event->end_date = $request->end_date . " " . $request->end_hour;
            }
            $event->description = $request->description;
            $event->location = $request->location;                
            $event->private = isset($request->private);
            $event->status = $request->status;
            $event->idband = $request->idband;


            //dd($request, $event);
            

            $ev = ApiController::callApi("/events?utc=$utc", true, "POST", $event);

            //dd($ev);

            //ApiController::callApi();

            return redirect("/calendari");
        }

        if($request->type == 'update')
        {
            $event = new \stdClass();                  
            
            $event->name = $request->eventModal_name;
            $event->start_date = $request->eventModal_start_date . " " . $request->eventModal_start_hour;
            if(isset($request->eventModal_end_date))
            {
                $event->end_date = $request->eventModal_end_date . " " . $request->eventModal_end_hour;
            }

            $event->description = $request->eventModal_description;
            $event->location = $request->eventModal_location;                
            $event->private = isset($request->eventModal_private);
            $event->status = $request->eventModal_status;
            $event->idband = $request->eventModal_idband;

            
            $assistencies = [];

            foreach($request->selAssis as $id => $assis)
            {
                $assistencia = new \stdClass();

                $assistencia->idevent = $request->eventModal_id;
                $assistencia->iduser = $id;
                $assistencia->answer = $assis;
                
                if(isset($request->selInstr[$id]))
                {
                    $assistencia->idinstrument = $request->selInstr[$id];
                }
                $assistencies[] = $assistencia;
            }
            //dd($request, $event, $assistencies);

            ApiController::callApi("/events/" . $request->eventModal_id . "?utc=$utc", true, "PUT", $event);

            //ApiController::callApi();

            return redirect("/calendari");
        }

        if($request->type == 'sign')
        {                  
            $assistance = new \stdClass();

            $assistance->answer = $request->assistenciaModal_assistance;
            $assistance->iduser = $request->assistenciaModal_iduser;

            //dd($assistance, $request);

            ApiController::callApi("/assistances/" . $request->assistenciaModal_id, true, "POST", $assistance);

            return redirect("/calendari");
        }
    	
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

        $membresBanda = [];
        
        $utc = session()->get("utc");

        if(isset($user->idband))
        {

            $events = ApiController::callApi("/events/calendar?idband=". $user->idband . "&utc=$utc");
            
            $membresBanda[$user->idband] = ApiController::callApi("/users/band/" . $user->idband);
        }
        else
        {
                if(isset($user->bands) && isset($user->bands) > 0)
            {
                foreach($user->bands as $band)
                {
                    if($band->role == "Editor")
                    {
                        $membresBanda[$band->idband] = ApiController::callApi("/users/band/" . $band->idband);
                    }
                }
            }

            $events = ApiController::callApi("/events/calendar?iduser=". $user->iduser . "&utc=$utc");
        }

        //dd($membresBanda);
        //hardcode
        //$events = json_decode('[{"idevent":1,"name":"Futbol Sala GIrona","description":"Anima al girona","location":"Estadi del girona","start_date":"2023-05-14T15:45:00.000Z","private":false,"status":"Per confirmar","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[{"idassistance":2,"answer":"Pendent","instrument":{"idinstrument":4,"name":"Caixa","sound_file_or_url":null},"user":{"iduser":3,"name":"Lluc Oliveras","email":"a","dni":null,"google_id":"1","birth_date":"1970-01-01","profile_photo":null}},{"idassistance":1,"answer":"Si + Transport","instrument":{"idinstrument":1,"name":"Repenique","sound_file_or_url":null},"user":{"iduser":1,"name":"Isaac Master","email":"soclisaac@gmail.com","dni":"41634247S","google_id":"114970352960464205366","birth_date":"2000-09-26","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/users/isaac_prats_renart_foto.png"}}]},{"idevent":3,"name":"Event 1","description":"Descripcio","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","start_date":"2023-05-30T18:00:00.000Z","private":false,"status":"Anulat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]},{"idevent":5,"name":"Event 3","description":"Descripcio","location":"Algun lloc","start_date":"2023-06-02T18:00:00.000Z","private":false,"status":"Confirmat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]}]');

        $data = [];

        //dd($events);

        foreach($events as $i => $e)
        {
            $event = new \stdClass();            

            $event->id = $e->idevent;
            $event->name = $e->name;
            $event->start = $e->start_date;
            $event->end = $e->end_date;
            $event->description = $e->description;
            $event->location = $e->location;
            $event->private = $e->private;
            $event->status = $e->status;
            $event->idband = $e->band->idband;
            $event->band_name = $e->band->name;
            if(isset($e->assistance))
            {
                $event->assistance = $e->assistance;
            }

            //Set Event Color for Status/Assistance 

            //dd($e);

            if(isset($user->idband))
            {
                $event->title = $e->name;
            }
            else
            {
                if(isset($e->assistance) && count($e->assistance) > 0)
                {
                    $i = 0;
                    $trobat = false;

                    while($i < count($e->assistance) && !$trobat)
                    {
                        if($user->iduser == $e->assistance[$i]->user->iduser)
                        {
                            $trobat = !$trobat;
                        }
                        else
                        {
                            $i++;
                        }
                    }

                    $userAssistance =  $trobat ? $e->assistance[$i] : null;

                    if(isset($userAssistance->answer))
                    {

                        switch($userAssistance->answer)
                        {
                            case "Si":
                            case "Si + Transport":
    
                                $event->title = "🟢 -  " . $e->name;
                                
                            break;
                            case "Pendent":
    
                                $event->title = "🟡 -  " . $e->name;
                                
                            break;
                            case "No":
    
                                $event->title = "🔴 -  " . $e->name;
                                
                            break;
                            default:
    
                                $event->title = "⚪ -  " . $e->name;
                        }
                    }
                    else
                    {
                        $event->title = "⚠️ -  " . $e->name;
                    }
                }
                else
                {
                    $event->title = "⚠️ -  " . $e->name;
                }
            }

            switch($event->status)
            {
                case "Per confirmar":

                    $event->color = "yellow";
                    
                break;

                case "Confirmat":
                    
                    $event->color = "lightgreen";
                    
                break;

                case "Anulat":
                    
                    $event->color = "purple";
                    
                break;

                case "Acabat":
                    
                    $event->color = "lightgray";
                    
                break;
            }

            $event->textColor = "black";
            $data[] = $event;
        }

        $responses = ApiController::callApi("/assistances/responses");
        $statuses = ApiController::callApi("/events/statuses");
        $data = json_encode($data);
        $jsonUser = json_encode($user);
        $membresBanda = json_encode($membresBanda);

        // dd($user, $data, $responses, $statuses, $jsonUser, $membresBanda);

        return view("calendari", compact("user", "responses", "statuses", "data", "jsonUser", "membresBanda"));
    }

    /**
     * Display a listing of the resource.
     */
    public function temes()
    {
        //Aqui carregara els temes
        $user = session()->get("user");

        //hardcode
        //$fakeuser = json_decode('{"bands":[{"idband": 1,"songs" : [{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"}]},{"idband": 2,"songs" : [{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"}]},{"idband": 3,"songs" : [{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"}]},{"idband": 4,"songs" : [{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"}]},{"idband": 5,"songs" : [{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"},{"name": "AAAAA","url": "URLLLLLLLLLLLLLLLLLL"}]}]}');



        return view("temes", compact("user"));
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
    
                    $band->users = ApiController::callApi("/users/band/" . $band->idband);
                    //hardcode
                    //$band->users = json_decode('[{"iduser":1,"name":"Isaac Master","email":"soclisaac@gmail.com","dni":"41634247S","google_id":"114970352960464205366","birth_date":"2000-09-26","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/users/isaac_prats_renart_foto.png","role":"Editor","instruments":[{"idinstrument":1,"name":"Repenique","sound_file_or_url":null,"main_instrument":true}]},{"iduser":3,"name":"Lluc Oliveras","email":"a","dni":null,"google_id":"1","birth_date":"1970-01-01","profile_photo":null,"role":"Member","instruments":[]}]');

                }
                
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
            dd($request);
            $trobat = false;
            $i = 0;
            while(!$trobat && $i < count($user->bands))
            {
                if($request->idband == $user->bands[$i]->idband)
                {
                    $trobat == !$trobat;
                    $band = $user->bands[$i];
                }
                else
                {
                    $i++;
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


        //dd($band, $editBand, $updatedBand, $request);


        $ok = ApiController::callApi("/bands/" . $band->idband, true, "PUT", $editBand);

        //dd($ok);

        if($ok)
        {
            $user = $updatedBand;
    
            session(["google_id" => $user->google_id, "user" => $user]);
            
    
            return $this->perfil();
        }
        else
        {
            $user->error = "No s'ha pogut actualitzar l'usuari";

            return view("perfil.editBanda", compact("user"));
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

        $utc = session()->get("utc");
        
        $events = ApiController::callApi("/events/community?utc=$utc");
        //$events = ApiController::callApi("/events/community?year=$any&month=$mes&day=$dia");

        foreach($events as $i => $event)
        {
            $date = new \DateTime($event->start_date);            

            $dia = $date->format("d/m/Y");
            $hora = $date->format("H:i");

            $events[$i]->hora = $hora;
            $events[$i]->dia = $dia;
        }

        //hardcode
        //$events = json_decode('[{"idevent":1,"name":"Futbol Sala GIrona","description":"Anima al girona","location":"Estadi del girona","start_date":"2023-05-14T15:45:00.000Z","private":false,"status":"Per confirmar","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[{"idassistance":2,"answer":"Pendent","instrument":{"idinstrument":4,"name":"Caixa","sound_file_or_url":null},"user":{"iduser":3,"name":"Lluc Oliveras","email":"a","dni":null,"google_id":"1","birth_date":"1970-01-01","profile_photo":null}},{"idassistance":1,"answer":"Si + Transport","instrument":{"idinstrument":1,"name":"Repenique","sound_file_or_url":null},"user":{"iduser":1,"name":"Isaac Master","email":"soclisaac@gmail.com","dni":"41634247S","google_id":"114970352960464205366","birth_date":"2000-09-26","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/users/isaac_prats_renart_foto.png"}}]},{"idevent":2,"name":"Aniversari Batukeiros 5 anys","description":"Parida festassa","location":"Barracons Udg","start_date":"2023-06-21T18:00:00.000Z","private":false,"status":"Confirmat","band":{"idband":2,"name":"Batukeiros UdG","email":"","location":"Universitat de Girona","nif":null,"profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_batukeiros.png","google_id":null},"assistance":[]},{"idevent":3,"name":"Event 1","description":"Descripcio","location":"ALgun lloc","start_date":"2023-05-30T18:00:00.000Z","private":false,"status":"Anulat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]},{"idevent":4,"name":"Event 2","description":"Descripcio","location":"ALgun lloc","start_date":"2023-06-30T18:00:00.000Z","private":false,"status":"Per confirmar","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]},{"idevent":5,"name":"Event 3","description":"Descripcio","location":"ALgun lloc","start_date":"2023-06-02T18:00:00.000Z","private":false,"status":"Confirmat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]},{"idevent":6,"name":"Event 4","description":"Descripcio","location":"ALgun lloc","start_date":"2023-06-15T18:00:00.000Z","private":false,"status":"Confirmat","band":{"idband":2,"name":"Batukeiros UdG","email":"","location":"Universitat de Girona","nif":null,"profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_batukeiros.png","google_id":null},"assistance":[]},{"idevent":7,"name":"Event 5","description":"Descripcio","location":"ALgun lloc","start_date":"2023-07-03T18:00:00.000Z","private":false,"status":"Per confirmar","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]},{"idevent":8,"name":"Event 6","description":"Descripcio","location":"ALgun lloc","start_date":"2023-07-17T18:00:00.000Z","private":false,"status":"Anulat","band":{"idband":2,"name":"Batukeiros UdG","email":"","location":"Universitat de Girona","nif":null,"profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_batukeiros.png","google_id":null},"assistance":[]},{"idevent":9,"name":"Event 7","description":"Descripcio","location":"ALgun lloc","start_date":"2023-08-26T18:00:00.000Z","private":false,"status":"Confirmat","band":{"idband":1,"name":"SonBarri","email":"sonbarri.gir@gmail.com","location":"C/ Santa Eugènia S/N, Centre Civic, Can Ninetes","nif":"12345678W","profile_photo":"https://batukapp-images.s3.eu-west-3.amazonaws.com/bands/logo_sonbarri.png","google_id":"117125523213243451006"},"assistance":[]}]');

        $bands = ApiController::callApi("/bands/public");


        return view("comunitat", compact("user", "events", "bands"));
    }
}