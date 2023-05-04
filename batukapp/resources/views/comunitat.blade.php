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
    Comunidah toh Reshulona
</div>    
@endsection
