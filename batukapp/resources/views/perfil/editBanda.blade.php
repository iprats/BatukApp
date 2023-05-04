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
                            <button class="btn btn-success" type="submit">Desar</button>
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
            </form>
            
            @if(isset($error))
                <span class="bg-danger bg-gradient">{{$error}}</span>
            @endif

            <hr>
            <div class="py-2 row">
                <div class="col-12">
                    MEMBRES
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection
