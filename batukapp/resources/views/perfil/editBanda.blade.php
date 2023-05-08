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
            <form action="{{route('banda.save')}}" method="post" enctype='multipart/form-data'>
            @csrf
            @method("PUT")
                <input type="hidden" name="idband" value="{{$banda->idband}}">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-6">
                            <h3>{{ __("Dades Banda") }}</h3>
                        </div>
                        <div class="col-6 text-right">
                            <button class="btn btn-warning" type="submit">Desar</button>
                            <a class="btn btn-danger" href="{{route('perfil.show')}}">Cancelar</a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="py-2 row">
                    <div class="col-9">
                        <label class="form-label" for="name">Nom:</label>
                        <input class="form-control" name="name" id="name" value="{{$banda->name}}"><br>
                        
                        <label class="form-label" for="nif">NIF:</label>
                        <input class="form-control" name="nif" id="nif"@if($banda->nif) value="{{$banda->nif}}" @endif><br>
                        
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
                <div class="p-6 row">
                    <div class="col-6">
                        <h3>{{ __("Gestionar Membres") }}</h3>
                    </div>
                    <div class="col-6 text-right">
                        <button class="btn btn-warning" type="submit">Desar</button>
                        <a class="btn btn-danger" href="{{route('perfil.show')}}">Cancelar</a>
                    </div>
                </div>
                <hr>
                <div class="py-2 row">
                            <div class="row">
                                <div class="col-2">
                                    <b>Nom</b>    
                                </div>
                                <div class="col">
                                    <b>Instruments</b>
                                </div>
                                <div class="col-2">
                                    <b>Nou instrument</b>
                                </div>
                            </div>
                    <div class="col-12">
                        @foreach($banda->members as $member)

                        
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
                                <div class="col-2">
                                    <select id="sel_instruments_{{$member->iduser}}" class="form-select" onchange="afegirInstrument(event, {{$member->iduser}})">
                                        <option value="" >Escull un instrument per afegir-lo</option>
                                    @if(isset($instruments))
                                        @foreach($instruments as $instrument)

                                            @if(!in_array($instrument->idinstrument, $member->ids_instruments))     <!-- Aqui haig de posar un if per si ja te la banda no mostrar-la al select -->
                                            <option id="inst_{{$member->iduser}}_{{$instrument->idinstrument}}" value="{{json_encode($instrument)}}" >{{$instrument->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>


<input type="hidden" id="arr_instruments_{{$member->iduser}}" name="instruments[{{$member->iduser}}]" value="@foreach($member->instruments as $key => $inst)@if($key != 0), @endif{{$inst->idinstrument}}@endforeach">
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>    


<button onclick="addOption(document.getElementById('sel_instruments_1'), 1)"> add   </button>
<button onclick="deleteOption(document.getElementById('sel_instruments_1'), 1)"> delete   </button>
<button onclick="alert(document.getElementById('arr_instruments_1').value)"> arr   </button>





<script>
    function afegirInstrument(e, idUser)
    {
        
        var instrument = JSON.parse(e.target.value);


        var div = $("#instruments_" + idUser);//Aquest es el div on coloquem les etiquetes
        var inp = $("#arr_instruments_" + idUser);//Aquest es el hidden input on afegim els ids dels instruments


        console.log(div.text());
        console.log(inp.val());

        if(inp.val() != "")
        {             
            lbl_instrument = "<label for='inst_name' id='lbl_inst_" + instrument.idinstrument + "'>, " + instrument.name + "</label>";
            div.append(lbl_instrument);
            inp.val(inp.val() + ", " + instrument.idinstrument);
        }
        else
        {
            lbl_instrument = "<label for='inst_name' id='lbl_inst_" + instrument.idinstrument + "'>" + instrument.name + "</label>";
            div.append(lbl_instrument);
            inp.val(instrument.idinstrument);
        }
        
        console.log(instrument.idband);

        deleteOption(document.getElementById("sel_instruments_" + idUser));
    }

    function addOption(select, opt)
    {
        console.log(select, opt);
    }

    function deleteOption(select)
    {
        select.remove(select.selectedIndex);
        
    }

</script>

@endsection
