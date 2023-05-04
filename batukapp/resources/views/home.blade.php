@extends('layouts.app')

@section('title', 'HOME')

@section('header')
<div>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </div>


@endsection

@section('content')
<div class="container">
    <div class="row py-12">
        <div class="col-6 text-center">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl">{{ __("Calendari") }}</h3>
                    <hr>

                    <div class="text-left ">
                        MINI CALENDARI
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-6 text-center">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl">{{ __("Temes") }}</h3>
                    <hr>

                    <div class="text-left">
                        Tema1<br>
                        Tema1<br>
                        Tema1<br>
                        Tema1<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 text-center">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl">{{ __("Perfil") }}</h3>
                    <hr>

                    <div class="text-left">
                        Nom: <br>
                        Cognoms: <br>
                        Instruments: <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 text-center">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="p-6 text-gray-900">
            <h3 class="text-xl">{{ __("Comunitat") }}</h3>
                    <hr>

                    <div class="text-left">
                        Proper BOLO ABSOLUT <br>
                        2n Proper BOLO ABSOLUT
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
        <!--
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Calendari") }}
                </div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Temes") }}
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Perfil") }}
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Comunitat") }}
                </div>
            </div>
        </div>-->

@endsection
