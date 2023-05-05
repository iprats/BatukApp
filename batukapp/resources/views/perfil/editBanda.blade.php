@extends('layouts.app')

@section('title', 'Editar Dades Banda')

@section('header')
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Dades Banda') }}
        </h2>
    </div>


@endsection

@section('content')
<div class="container">
    <div class="row py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form action="/banda/{{$key}}" method="post" enctype='multipart/form-data'>
            @csrf
            @method("PUT")
                
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-6">
                            <h3>{{ __("Dades Banda") }}</h3>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-warning" type="submit">Desar</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="py-2 row">
                    <div class="col-9">
                        <label class="form-label" for="name">Nom:</label>
                        <input class="form-control" id="name" value="{{$banda->name}}"><br>
                        
                        <label class="form-label" for="nif">NIF:</label>
                        <input class="form-control" id="nif"@if($banda->nif) value="{{$banda->nif}}" @endif><br>
                        
                        <label class="form-label" for="email">Email:</label>
                        <label class="form-label" id="email">{{$banda->email}}</label><br>
                    </div>
                    <div class="col-3">
                        <label for="profile_photo">Logo</label>
                        <img src="{{$banda->profile_photo}}" alt="Logo {{$banda->name}}" style="max: width 300px;">
                        <input class="form-control" type="file" name="profile_photo" id="profile_photo">
                    </div>
                </div>
            
            @if(isset($error))
                <span class="bg-danger bg-gradient">{{$error}}</span>
            @endif

        </div>
    </div>
    <div class="row py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-2 row">
                    <div class="col-6">
                        <h3>{{ __("Gestionar Membres") }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <button class="btn btn-warning" type="submit">Desar</button>
                    </div>
                </div>
                <hr>
                <div class="py-2 row">
                    <div class="col-12">
                        @foreach($banda->members as $member)
                            <div class="row">
                                <div class="col-3">{{$member->name}}</div>
                                <div class="col" id="instruments_{{$member->iduser}}"></div>
                                <div class="col">
                                    <select name="instruments" id="instruments" class="form-select" onchange="afegirEtiqueta(event, {{$member->iduser}})">
                                        <option value="" >Escull un instrument per afegir-lo</option>
                                        @foreach($member->bands as $instrument)
                                            <option value="{{json_encode($instrument)}}" >{{$instrument->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>    

<script>
    function afegirEtiqueta(e, idUser)
    {
        var instrument = e.target.value;
        var instrument = JSON.parse(instrument);
        console.log(instrument);
        var div = document.getElementById("instruments_" + idUser);
        div.append(instrument.name + ",");
    }
</script>

@endsection
