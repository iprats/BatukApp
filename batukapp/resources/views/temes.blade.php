@extends('layouts.app')

@section('title', 'Temes')

@section('header')
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Temes') }}
        </h2>
    </div>


@endsection

@section('content')
<div class="container">
    <div class="py-12">
        @if(isset($user->bands) && count($user->bands) > 0)
            @foreach($user->bands as $banda)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4 py-2" style="heigth:70vh">
                <div class="p-6 text-gray-900">

                    <div class="row border-2 p-3 rounded">
                        <h1 class="col-11 text-xl"><b>{{$banda->name}}</b></h1>
                        <span class="col"><b><button class="" onclick="$('.temes_{{$banda->idband}}').toggle()"><i class="bi bi-caret-down-fill"></i></button></b></span>
                        <span class="temes_{{$banda->idband}}" class="col" hidden><b><button class="" onclick="$('.temes_{{$banda->idband}}').toggle()"><i class="bi bi-caret-up-fill"></i></button></b></span>
                        <hr>
                    </div>

                    <div class="temes_{{$banda->idband}} row py-4">
                        @if(isset($banda->songs) && count($banda->songs) > 0)
                            @foreach($banda->songs as $tema)
                                
                            
                                <div class="col-2 p-3"><h1 class="text-xl"><b>- {{$tema->name}}</b></h1></div>
                                <div class="col p-1">
                                    <audio controls src="{{$tema->url}}"></audio>
                                </div>
                            @endforeach
                        @else
                            <h1 class="text-center"><b>Aquesta Banda encara no te cap tema</b></h1>
                        @endif
                    </div>




                </div>
            </div>
            @endforeach
        @elseif(isset($user->songs) && count($user->songs) > 0)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-4 py-2" style="heigth:70vh">
            <div class="p-6 text-gray-900">

<!-- <div class="row border-2 p-3 rounded bg-danger">
    <h1 class="col-11 text-xl"><b>{ {$ user->name} }</b></h1>
    <span class="col-1"><b><button class="btn btn-danger" onclick="$('#temes_{ {$ user->idband} }').toggle()">amaga</button></b></span>
</div> -->

                <div id="temes_{{$user->idband}}" class="row">
                    
                    @foreach($user->songs as $tema)
                        
                    
                    <div class="col-2 p-3"><h1 class="text-xl"><b>- {{$tema->name}}</b></h1></div>
                        <div class="col">
                            <audio controls src="{{$tema->url}}"></audio>
                        </div>
                    @endforeach
                </div>




            </div>
        </div>


        @endif
    </div>
</div>    
@endsection
