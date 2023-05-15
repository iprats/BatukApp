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
                        <div class="row">
                            <h3 class="text-xl"><b>{{ __("Calendari") }}</b></h3>
                            <hr>
                        </div>

                        <div class="row p-1" style="height:24vh; overflow-y:auto">
                            @if(isset($eventsCalendari))



                                    @if(isset($user->iduser) && count($user->bands) > 1)
                                    <div class="col-3" style="display:flex; flex-direction: row; justify-content: center; align-items: center"><b>Event</b></div>
                                    <div class="col-4" style="display:flex; flex-direction: row; justify-content: center; align-items: center"><b>Localitzacio</b></div>
                                    <div class="col-3" style="display:flex; flex-direction: row; justify-content: center; align-items: center"><b>Dia/Hora</b></div>
                                    <div class="col-2" style="display:flex; flex-direction: row; justify-content: center; align-items: center"><b>Banda</b></div>
                                    @else 
                                    <div class="col-4" style="display:flex; flex-direction: row; justify-content: center; align-items: center"><b>Event</b></div>
                                    <div class="col-4" style="display:flex; flex-direction: row; justify-content: center; align-items: center"><b>Localitzacio</b></div>
                                    <div class="col-2" style="display:flex; flex-direction: row; justify-content: center; align-items: center"><b>Dia</b></div>
                                    <div class="col-2" style="display:flex; flex-direction: row; justify-content: center; align-items: center"><b>Hora</b></div>
                                    @endif


                                @foreach($eventsCalendari as $event)

                                    @if(isset($user->iduser) && count($user->bands) > 1)
                                    <div class="col-3 border-top" style="display:flex; flex-direction: row; justify-content: center; align-items: center">{{($event->name)}}</div>
                                    <div class="col-4 border-top" style="display:flex; flex-direction: row; justify-content: center; align-items: center">{{$event->location}}</div>
                                    <div class="col-3 border-top" style="display:flex; flex-direction: row; justify-content: center; align-items: center">{{$event->dia}}<br>{{$event->hora}}</div>
                                    <div class="col-2 border-top" style="display:flex; flex-direction: row; justify-content: center; align-items: center"><img style="height:6vh;border-radius:50%;" src="{{$event->band->profile_photo}}"></div>
                                    @else
                                    <div class="col-4 border-top" style="display:flex; flex-direction: row; justify-content: center; align-items: center">{{($event->name)}}</div>
                                    <div class="col-4 border-top" style="display:flex; flex-direction: row; justify-content: center; align-items: center">{{$event->location}}</div>
                                    <div class="col-2 border-top" style="display:flex; flex-direction: row; justify-content: center; align-items: center">{{$event->dia}}</div>
                                    <div class="col-2 border-top" style="display:flex; flex-direction: row; justify-content: center; align-items: center">{{$event->hora}}</div>
                                    
                                    @endif

                                @endforeach
                            @else

                                <div class="col-12 "><h1><b>No hi ha esdeveniments a la vista</b></h1></div>

                            @endif
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-6 text-center">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg" style="height:32vh">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-xl"><b>{{ __("Temes") }}</b></h3>
                        <hr>

                        <div class="text-center row py-2" style="height:24vh; overflow-y:auto">
                            @if(isset($user->bands) && count($user->bands) > 0)
                                @foreach($user->bands as $banda)
                                    <h1 class="text-xl"><b>{{$banda->name}}</b></h1>
                                    @if(isset($banda->songs) && count($banda->songs) > 0)
                                    <script>
                                        var audio = [];
                                        var isPlaying = [];
                                    </script>
                                        @foreach($banda->songs as $tema)
                                            <div class="col-4 py-1">- {{$tema->name}}</div>
                                            <div class="col py-1">
                                                <button class="btn btn-danger" onclick="togglePlay_{{$tema->idsong}}('audio_{{$tema->idsong}}')">Play</button>
                                                <audio id="audio_{{$tema->idsong}}" src="{{$tema->url}}"></audio>
                                            </div>

                                            <script>
                                                audio[{{$tema->idsong}}] = document.getElementById("audio_{{$tema->idsong}}");

                                                isPlaying[{{$tema->idsong}}] = false;

                                                function togglePlay_{{$tema->idsong}}() {
                                                
                                                isPlaying[{{$tema->idsong}}] ? audio[{{$tema->idsong}}].pause() : audio[{{$tema->idsong}}].play();
                                                };

                                                audio[{{$tema->idsong}}].onplaying = function() {
                                                isPlaying[{{$tema->idsong}}] = true;
                                                };
                                                audio[{{$tema->idsong}}].onpause = function() {
                                                isPlaying[{{$tema->idsong}}] = false;
                                                };

                                                console.log(audio[{{$tema->idsong}}]);

                                            </script>
                                        @endforeach
                                    @else
                                        <h1 class="text-center"><b>Aquesta Banda encara no te cap tema</b></h1>
                                    @endif
                                @endforeach
                            @elseif(isset($user->songs) && count($user->songs) > 0)
                            <script>
                                var audio = [];
                                var isPlaying = [];
                            </script>
                                @foreach($user->songs as $tema)
                                            <div class="col-4 py-1"><h1 class="text-xl"><b>- {{$tema->name}}</b></h1></div>
                                            <div class="col py-1">
                                                <button class="btn btn-danger" onclick="togglePlay_{{$tema->idsong}}('audio_{{$tema->idsong}}')">Play</button>
                                                <audio id="audio_{{$tema->idsong}}" src="{{$tema->url}}"></audio>
                                            </div>

                                            <script>
                                                audio[{{$tema->idsong}}] = document.getElementById("audio_{{$tema->idsong}}");

                                                isPlaying[{{$tema->idsong}}] = false;

                                                function togglePlay_{{$tema->idsong}}() {
                                                
                                                isPlaying[{{$tema->idsong}}] ? audio[{{$tema->idsong}}].pause() : audio[{{$tema->idsong}}].play();
                                                };

                                                audio[{{$tema->idsong}}].onplaying = function() {
                                                isPlaying[{{$tema->idsong}}] = true;
                                                };
                                                audio[{{$tema->idsong}}].onpause = function() {
                                                isPlaying[{{$tema->idsong}}] = false;
                                                };

                                                console.log(audio[{{$tema->idsong}}]);

                                            </script>
                                @endforeach
                            @endif
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
                    <h3 class="text-xl"><b>{{ __("Perfil") }}</b></h3>
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
                    <h3 class="text-xl"><b>{{ __("Comunitat") }}</b></h3>
                    <hr>
                    <div class="row text-left py-2 mt-2" style="height:24vh; overflow-y:auto">
                        
                    @foreach($eventsComunitat as $event)

                        <div class="col-6 overflow-hidden shadow-xl rounded-lg my-1 p-3" style="background-color: rgba(222,222,222,20%)">


                            <div class="text-center"><b>{{($event->name)}} - {{($event->band->name)}}</b></div>
                            <div>📌{{$event->location}}</div>

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
