@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('header')
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Perfil') }}
        </h2>
    </div>


@endsection

@section('content')
<div class="container">
    <div class="row py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form action="/perfil/save" method="POST" enctype='multipart/form-data'>
            @csrf
            @method("PUT")
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-6">
                            <h3>{{ __("Dades Personals") }}</h3>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-success" type="submit">Desar</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="py-2 row">
                    <div class="col-9">
                        <label class="form-label" for="email">Email:</label>
                        <label class="form-label" name="email" id="email">{{$user->email}}</label><br>

                        <label class="form-label" for="name">Nom:</label>
                        <input class="form-control" name="name" id="name" value="{{$user->name}}"><br>
                        
                        <label class="form-label" for="dni">DNI:</label>
                        <input class="form-control" name="dni" id="dni"@if($user->dni) value="{{$user->dni}}" @endif><br>
                        
                        <label class="form-label" for="birth_date">Data de naixement:</label>
                        <input type="date" class="form-date" name="birth_date" id="birth_date" @if($user->birth_date) value="{{$user->birth_date}}" @endif><br>
                    </div>
                    <div class="col-3">
                        <label class="form-label" for="profile_photo"></label>
                        <img src="__user->profile_photo__" alt="Imatge de Perfil {{$user->name}}" style="max: width 300px;">
                        <input class="form-control" type="file" name="profile_photo" id="profile_photo">
                    </div>
                </div>
            </form>

            @if(isset($error))
                <span class="bg-danger bg-gradient">{{$error}}</span>
            @endif
        </div>
    </div>
</div>    

@endsection
