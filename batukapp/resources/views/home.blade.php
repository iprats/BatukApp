@extends('layouts.app')

@section('title', 'Inici')

@section('header')
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inici') }}
        </h2>
    </div>


@endsection

@section('content')
<div class="container">
        <div class="row py-12">

    @if((isset($user->bands) && count($user->bands) > 0) || isset($user->idband))
    
            <div class="col-6 text-center">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg" style="height:32vh">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl">{{ __("Calendari") }}</h3>
                        <hr>

                        <div class="row text-left py-2 text-center" style="height:24vh; overflow-y:auto">
                            @if(isset($eventsCalendari))
                                <div class="col-3"><b>Event</b></div>
                                <div class="col-4"><b>Localitzacio</b></div>
                                <div class="col-3"><b>Dia</b></div>
                                <div class="col-2"><b>Hora</b></div>
                                @foreach($eventsCalendari as $event)

                                    <div class="col-3">{{($event->name)}}</div>
                                    <div class="col-4">{{$event->location}}</div>
                                    <div class="col-3">{{$event->dia}}</div>
                                    <div class="col-2">{{$event->hora}}</div>

                                @endforeach
                            @else

                                <div class="col-12 text-center"><h1><b>No hi ha esdeveniments a la vista</b></h1></div>

                            @endif
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-6 text-center">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg" style="height:32vh">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl">{{ __("Temes") }}</h3>
                        <hr>

                        <div class="text-center">
                            <div class="row py-2">

                            @foreach($temes as $tema)

                                <div class="col-6">{{$tema}}</div>
                                <div class="col-6"><button class="btn btn-danger">PLAY</button></div>
                                <div class="col-1"></div>
                                <div class="col-10"><hr></div>
                                <div class="col-1"></div>

                            @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">

    @endif
        <div class="col-6 text-center">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg" style="height:32vh">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl">{{ __("Perfil") }}</h3>
                    <hr>

                    <div class="text-left py-2">
                        <label class="form-label" for="name">Nom: {{$user->name}}</label><br>
                        @if(isset($user->iduser))
                        <label class="form-label" for="dni">DNI: {{$user->dni}}</label><br>
                            @if(isset($user->bands) && count($user->bands) > 0)
                            <label class="form-label" for="bands">Bandes: /</label>
                                @foreach($user->bands as $band)
                                    <label class="form-label" for="band-name"> {{$band->name}} /</label>
                                @endforeach
                            @endif
                        @elseif(isset($user->idband))
                        <label class="form-label" for="nif">NIF: {{$user->nif}}</label><br>
                            @if(isset($user->users) && count($user->users) > 0)
                            <label class="form-label" for="membres">Membres: /</label>
                                @foreach($user->users as $member)
                                    <label class="form-label" for="member-name"> {{$member->name}} /</label>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 text-center">
            <div class="bg-white overflow-y-visible shadow-xl rounded-lg" style="height:32vh;">
                <div class="p-6 text-gray-900">
                    @if(isset($user->iduser))
                    <h3 class="text-xl">{{ __("Comunitat") }}</h3>
                    <hr>
                    <div class="row text-left py-2 mt-2" style="height:24vh; overflow-y:auto">
                        
                    @foreach($eventsComunitat as $event)

                        <div class="col-6 overflow-hidden shadow-xl rounded-lg my-1 p-3" style="background-color: rgba(222,222,222,20%)">


                            <div class="text-center"><b>{{($event->name)}}</b></div>
                            <div>🗺️{{$event->location}}</div>

                            <div>📆{{$event->dia}} - 🕒{{$event->hora}}</div>
                        </div>

                    @endforeach
                    

                    </div>
                    @else
                    <h3 class="text-xl">{{ __("Composar") }}</h3>
                    <hr>
                    <div class="text-left">
                        PARTITURES
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection
