@extends('layouts.app')

@section('title', 'Comunitat')

@section('header')
<div>
    <div class="row" name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight col-6">
            {{ __('Comunitat') }}
        </h2>
        <div class="col-6 text-right">
            @if(!session()->has("user"))
            <a href="/google-auth/redirect" class="btn btn-danger">Log in GOOGLE</a>
            @endif
        </div>
    </div>


@endsection

@section('content')
<div class="container">
    <div class="py-12" style="column-count:3; column-gap:1em;">
        @foreach($events as $e)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 my-2" style="display:inline-block; float:left; width:100%">
                <div class="text-center">
                    <h1 class="text-xl"><b>{{$e->name}}</b></h1>
                    <hr>
                </div>
                <div class="p-2">
                    @if(isset($e->main_photo))
                        <img src="{{$e->main_photo}}" alt="Imatge {{$e->name}}" class="my-2 rounded" style="width:100%;">
                    @endif
                    <p class="text-lg row align-middle mt-4"> <span class="text-center col-2"><img class="shadow" src="{{$e->band->profile_photo}}" style="width:100%;border-radius:50%"></span> <span class="col text-xl"><b>{{$e->band->name}}</b></span></p><br>
                    <p class="text-lg row"> <span class="text-center col-2"> 📌 </span> <span class="col"><b>{{$e->location}}</b></span></p>
                    <p class="text-lg row"> <span class="text-center col-2"> 📆 </span> <span class="col"><b>{{$e->dia}}</b></span></p>
                    <p class="text-lg row"> <span class="text-center col-2"> 🕒 </span> <span class="col"><b>{{$e->hora}}</b></span></p>
                    <br>
                    <p class="text-lg">{{$e->description}}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="py-12">
        <div class="text-center">
            <h1 class="text-xl"><b>Bandes</b></h1>
            <hr>
        </div><br>

        <div class="py-4" style="column-count:3; column-gap:1em;">
        @foreach($bands as $b)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 my-2" style="display:inline-block; float:left; width:100%">
                <div class="text-center row">
                    <div class="col-4">
                        <img style="width:100%;border-radius:50%" src="{{$b->profile_photo}}">
                    </div>
                    <div class="col-8 align-middle"><br><br>
                        <h1 class="col text-xl"><b>{{$b->name}}</b></h1>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
    <!-- <div class="text-center">
        <h1 class="text-xl"><b>Bandes</b></h1>
        <hr>
    </div> -->
</div>    
@endsection
