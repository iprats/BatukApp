@extends('layouts.app')

@section('title', 'Perfil')

@section('header')
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </div>


@endsection

@section('content')
<div class="container">
    @if(isset($user->iduser))
        <div class="row py-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-6">
                            <h3>{{ __("Dades Personals") }}</h3>
                        </div>
                        <div class="col-6 text-right">

                            <a class="btn btn-warning" href="{{route('perfil.edit')}}">Editar</a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="py-2 row">
                    <div class="col-9">
                        <label class="form-label" for="nom">Nom:</label>
                        <label class="form-label" id="nom">{{$user->name}}</label><br>
                        
                        <label class="form-label" for="dni">DNI:</label>
                        <label class="form-label" id="dni">@if(isset($user->dni)) {{$user->dni}} @endif</label><br>
                        
                        <label class="form-label" for="birth_date">Data de naixement:</label>
                        <label class="form-label" id="birth_date">@if(isset($user->birth_date)){{$user->birth_date}}@endif</label><br>
                        
                        <label class="form-label" for="email">Email:</label>
                        <label class="form-label" id="email">{{$user->email}}</label><br>
                    </div>
                        <div class="col-3">
                            <label class="form-label" for="profile_photo">Foto de Perfil:</label>
                            <img id="profile_photo" @if(isset($user->profile_photo)) src="{{$user->profile_photo}}" @endif alt="Imatge de Perfil {{$user->name}}" style="max: width 300px;">
                        </div>
                </div>
            </div>
        </div>
        @if(isset($user->bands) && count($user->bands) > 0)
            @foreach($user->bands as $key => $banda)
            
                <div class="row py-12">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="row">
                                <div class="col-6">
                                    <h3><b>{{$banda->name}}</b></h3>
                                </div>
                            @if($banda->editor)
                                <div class="col-6 text-right">
                                    <a class="btn btn-warning" href="/banda/{{$key}}">Editar</a>
                                </div>
                            @endif
                            </div>
                        </div>
                        <hr>

                        <div class="py-2 row">
                            <div class="col-9">
                                
                                <label class="form-label" for="email">Email:</label>
                                <label class="form-control" id="email">{{$banda->email}}</label><br>
                            @if($banda->editor)
                            
                                <label class="form-label" for="nif">NIF:</label>
                                <label class="form-control" id="nif">{{$banda->nif}}</label><br>
                                
                                <label class="form-label" for="n_membres">Nº de Membres:</label>
                                <label class="form-control" id="n_membres">@if($banda->members){{count($banda->members)}}@endif</label><br>

                                <label class="form-label" for="membres">Membres:</label>
                                <ul class="list-group">
                                    @foreach($banda->members as $membre)
                                        <li class="list-group-item">{{$membre->name}}</li>
                                    @endforeach
                                </ul>
                            @endif

                            </div>
                            <div class="col-3">
                                <label class="form-label" for="logo">Logo Banda:</label>
                                <img id="logo" src="{{$banda->profile_photo}}" alt="Logo {{$banda->name}}" style="max: width 300px;">
                            </div>
                        </div>
                        <hr>
                        
                        <div class="py-2 row">
                            <div class="col-4">
                                <label class="form-label" for="instruments">Els meus instruments:</label>
                                <ul class="list-group">
                                    @foreach($banda->instruments as $instrument)
                                        <li class="list-group-item @if($instrument->main_instrument) active @endif">{{$instrument->name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @else

        <div class="row py-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-6">
                            <h3>{{ __("Dades Banda") }}</h3>
                        </div>
                        <div class="col-6 text-right">

                            <a class="btn btn-warning" href="{{route('banda.edit', $user->name)}}">Editar</a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="py-2 row">
                    <div class="col-9">
                        <label class="form-label" for="nom">Nom:</label>
                        <label class="form-label" id="nom">{{$user->name}}</label><br>
                        
                        <label class="form-label" for="nif">NIF:</label>
                        <label class="form-label" id="nif">@if(isset($user->nif)) {{$user->nif}} @endif</label><br>
                        
                        <label class="form-label" for="location">Local:</label>
                        <label class="form-label" id="location">@if(isset($user->location)){{$user->location}}@endif</label><br>
                        
                        <label class="form-label" for="email">Email:</label>
                        <label class="form-label" id="email">{{$user->email}}</label><br>
                    </div>
                        <div class="col-3">
                            <label class="form-label" for="profile_photo">Foto de Perfil:</label>
                            <img id="profile_photo" @if(isset($user->profile_photo)) src="{{$user->profile_photo}}" @endif alt="Imatge de Perfil {{$user->name}}" style="max: width 300px;">
                        </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-6">
                            <h3>{{ __("Membres") }}</h3>
                        </div>
                        <div class="col-6 text-right">

                            <a class="btn btn-warning" href="{{route('banda.edit', $user->name)}}">Editar</a>
                        </div>
                    </div>
                </div>
                <hr>

                        <div class="row">
                                <div class="col-2">
                                    <b>Nom</b>    
                                </div>
                                <div class="col">
                                    <b>Instruments</b>
                                </div>

                                @if(isset($user->idband))
                                <div class="col-2">
                                    <b>Rol</b>
                                </div>
                                @endif
                            </div>
                    <div class="col-12">
                        @foreach($user->members as $member)

                        
                            <div class="row">
                                <div class="col-2">{{$member->name}}</div>
                                <div class="col" id="instruments_{{$member->iduser}}">
                                    @if(isset($member->instruments))
                                    @foreach($member->instruments as $key => $inst)
                                        @if($key != 0), @endif
                                        <label for="inst_name" id="lbl_inst_{{$inst->idinstrument}}">{{$inst->name}}</label>
                                    @endforeach
                                    @endif
                                </div>
                                @if(isset($user->idband))
                                <div class="col-2">
                                    <label for="role">@if(isset($member->role)) {{$member->role}} @endif</label>
                                </div>
                                @endif
                            </div>


                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    @endif
</div>    

@endsection
