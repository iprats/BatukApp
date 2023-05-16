@extends('layouts.app')

@section('title', 'Full Calendar')




@section('header')

<div>
    <div class="row">
        <div class="col-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Calendari') }}
            </h2>
        </div>
        <div class="col-6 text-right">
        <!-- Button create event modal -->
                <!-- NOMES PER EDITORS I BANDES -->

            <button type="button" class="btn btn-warning" id="btnCrearEvent" data-bs-toggle="modal" data-bs-target="#createEventModal">
            Crear Event
            </button>
        </div>

    </div>

<!-- Event Modal -->
<div class="modal" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Editar Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form action="{{route('calendari.action')}}" method="POST">
                @csrf
                <div class="modal-body row">

                    <div class="col-6">
                        <input class="form-label" type="number" name="eventModal_id" id="eventModal_id" hidden>
                    
                        <label class="form-label" for="eventModal_name">Nom:</label>
                        <input class="form-control" name="eventModal_name" id="eventModal_name" required><br>
                    </div>
                    

                    @if(isset($user->idband))
                    <input type="hidden" name="eventModal_idband" id="eventModal_idband">


                    <div class="col-6">
                        <label class="form-label" for="eventModal_location">Ubicacio:</label>
                        <input class="form-control" name="eventModal_location" id="eventModal_location" required><br>
                    </div>
                    <div class="col-12">

                        <label class="form-label" for="eventModal_description">Descripcio:</label>
                        <input class="form-control" name="eventModal_description" id="eventModal_description"><br>
                    </div>
                    @else
                    <div class="col-6">
                        <label class="form-label" for="eventModal_idband">Banda:</label>
                        <select class="form-control" name="eventModal_idband" id="eventModal_idband" required>
                            @foreach($user->bands as $band)
                            @if($band->role == "Editor")
                                <option value="{{$band->idband}}">{{$band->name}}</option>
                            @endif
                            @endforeach

                        </select>
                        <br>
                    </div>

                    <div class="col-6">


                        <label class="form-label" for="eventModal_location">Ubicacio:</label>
                        <input class="form-control" name="eventModal_location" id="eventModal_location" required><br>
                    </div>
                    <div class="col-6">

                        <label class="form-label" for="eventModal_description">Descripcio:</label>
                        <input class="form-control" name="eventModal_description" id="eventModal_description"><br>
                    </div>
                    @endif

                    <div class="col-6">

                        <label class="form-label" for="eventModal_start_date">Dia Inici:</label>
                        <input type="date"class="form-control" name="eventModal_start_date" id="eventModal_start_date" required><br>
                    </div>
                    <div class="col-6">

                        <label class="form-label" for="eventModal_start_hour">Hora Inici:</label>
                        <input type="time" class="form-control" name="eventModal_start_hour" id="eventModal_start_hour" required><br>
                    </div>
                    <!-- <div class="col-6">

                        <label class="form-label" for="eventModal_end_date">Dia Final:</label>
                        <input type="date"class="form-control" name="eventModal_end_date" id="eventModal_end_date"><br>
                    </div>
                    <div class="col-6">

                        <label class="form-label" for="eventModal_end_hour">Hora Final:</label>
                        <input type="time" class="form-control" name="eventModal_end_hour" id="eventModal_end_hour"><br>
                    </div> -->
                    <div class="col-6">

                        <label class="form-label" for="eventModal_status">Estat:</label>
                        <select class="form-control" name="eventModal_status" id="eventModal_status" required>
                            @foreach($statuses as $status)
                                <option value="{{$status}}">{{$status}}</option>
                            @endforeach
                        </select>
                        <br>
                    </div>
                    <div class="col-6">

                        <!-- <label class="form-label" for="eventModal_main_photo" >Imatge principal:</label>
                        <input type="file" class="form-control" name="eventModal_main_photo" id="eventModal_main_photo"><br> -->

                    </div>
                    <div class="col-6">

                        <input class="form-control" type="checkbox" name="eventModal_private" id="eventModal_private">
                        <label class="form-label" for="eventModal_private">Privat</label><br>
<input type="hidden" name="type" value="update">
                    </div>
                

                <br>
                <hr>
                <br>

                <div class="row">
                    <label class="form-label col">Assistencia</label>
                    <a class="col text-right" onclick="$('.assistenciaBanda').toggle()"><i class="bi bi-caret-up-fill assistenciaBanda"></i><i class="bi bi-caret-down-fill assistenciaBanda" style="display:none"></i></a>
                </div><br>

                <div id="assistenciaBanda" class="assistenciaBanda row">
<!-- Aqui carregare el llistat de usuaris per assignar assistencia i instruments als que assisteixin -->
    

                </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" style="color:black" data-bs-dismiss="modal">Tanca</button>
                    <button type="submit" class="btn btn-warning">Guardar Canvis</button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create Event Modal -->
<div class="modal" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEventModalLabel">Crear Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form action="{{route('calendari.action')}}" method="POST">
                @csrf
                <div class="modal-body row">


                    <div class="col-6">
                    
                        <label class="form-label" for="name">Nom:</label>
                        <input class="form-control" name="name" id="name" required><br>
                    </div>

                    @if(isset($user->idband))
                    
                    <input type="hidden" name="idband" id="idband">

                    <div class="col-6">
                        <label class="form-label" for="location">Ubicacio:</label>
                        <input class="form-control" name="location" id="location" required><br>
                    </div>

                    <div class="col-12">

                        <label class="form-label" for="description">Descripcio:</label>
                        <input class="form-control" name="description" id="description"><br>
                    </div>
                    @else
                    <div class="col-6">
                        <label class="form-label" for="idband">Banda:</label>
                        <select class="form-control" name="idband" id="idband" required>
                            @foreach($user->bands as $band)
                            @if($band->role == "Editor")
                                <option value="{{$band->idband}}">{{$band->name}}</option>
                            @endif
                            @endforeach

                        </select>
                        <br>
                    </div>

                    <div class="col-6">
                        <label class="form-label" for="location">Ubicacio:</label>
                        <input class="form-control" name="location" id="location" required><br>
                    </div>

                    <div class="col-6">

                        <label class="form-label" for="description">Descripcio:</label>
                        <input class="form-control" name="description" id="description"><br>
                    </div>
                    @endif

                    <div class="col-6">

                        <label class="form-label" for="start_date">Dia Inici:</label>
                        <input type="date"class="form-control" name="start_date" id="start_date" required><br>
                    </div>

                    <div class="col-6">

                        <label class="form-label" for="start_hour">Hora Inici:</label>
                        <input type="time" class="form-control" name="start_hour" id="start_hour" required><br>
                    </div>

                    <!-- <div class="col-6">

                        <label class="form-label" for="end_date">Dia Final:</label>
                        <input type="date"class="form-control" name="end_date" id="end_date"><br>
                    </div>

                    <div class="col-6">

                        <label class="form-label" for="end_hour">Hora Final:</label>
                        <input type="time" class="form-control" name="end_hour" id="end_hour"><br>
                    </div> -->

                    <div class="col-6">

                        <label class="form-label" for="status">Estat:</label>
                        <select class="form-control" name="status" id="status" required>
                            @foreach($statuses as $status)
                                <option value="{{$status}}">{{$status}}</option>
                            @endforeach
                        </select>
                        <br>
                    </div>

                    <div class="col-6">

                        <!-- <label class="form-label" for="main_photo" >Imatge principal:</label>
                        <input type="file" class="form-control" name="main_photo" id="main_photo"><br> -->

                    
                    </div>

                    <div class="col-6">

                        <input class="form-control" type="checkbox" checked name="private" id="private">
                        <label class="form-label" for="private">Privat</label><br>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" style="color:black" data-bs-dismiss="modal">Tancar</button>
                    <button type="submit" class="btn btn-warning">Crear</button>
                    <!-- -->

                </div>
                <input type="hidden" name="type" value="add">
            </form>
        </div>
    </div>
</div>

<!-- Event Modal Show -->
<div class="modal" id="eventShow" tabindex="-1" aria-labelledby="eventShowLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventShowLabel">Mostrar Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body row">

                <div class="col-6">
                
                    <label class="form-label" name="eventShow_id" id="eventShow_id" hidden></label>
                    
                    <label class="form-label" for="eventShow_name">Nom:</label>
                    <label class="form-label" name="eventShow_name" id="eventShow_name"></label><br>

                    <label class="form-label" for="eventShow_location">Ubicacio:</label>
                    <label class="form-label" name="eventShow_location" id="eventShow_location"></label><br>

                    <label class="form-label" for="eventShow_start_date">Dia Inici:</label>
                    <label class="form-label" name="eventShow_start_date" id="eventShow_start_date"></label><br>

                    <label class="form-label" for="eventShow_start_hour">Hora Inici:</label>
                    <label class="form-label" name="eventShow_start_hour" id="eventShow_start_hour"></label><br>

                    <label class="form-label" for="eventShow_status">Estat:</label>
                    <label class="form-label" name="eventShow_status" id="eventShow_status"></label><br>

                    <label class="form-label" name="eventShow_private" id="eventShow_private"></label>

                </div>

                <div class="col-6">
                @if(isset($user->iduser))
                    <label class="form-label" for="eventShow_band_name">Banda:</label>
                    <label class="form-label" name="eventShow_idband" id="eventShow_idband" hidden></label>
                    <label class="form-label" name="eventShow_band_name" id="eventShow_band_name"></label><br>
                @else
                    <label class="form-label" name="eventShow_idband" id="eventShow_idband" hidden></label>
                @endif

                    <label class="form-label" for="eventShow_description">Descripcio:</label>
                    <label class="form-label" name="eventShow_description" id="eventShow_description"></label><br>

                    <!-- <label class="form-label" for="eventShow_end_date">Dia Final:</label>
                    <label class="form-label" name="eventShow_end_date" id="eventShow_end_date"></label><br>

                    <label class="form-label" for="eventShow_end_hour">Hora Final:</label>
                    <label class="form-label" name="eventShow_end_hour" id="eventShow_end_hour"></label><br> -->

                    <!-- <label class="form-label" for="eventShow_main_photo" >Imatge principal:</label>
                    <input class="form-label" name="eventShow_main_photo" id="eventShow_main_photo"><br> -->

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" style="color:black" data-bs-dismiss="modal">Tancar</button>

                <!-- NOMES PER EDITORS I BANDES -->
                <button type="button" class="btn btn-warning" id="btnEditarEvent" onclick="obrirModalEvent($('#eventShow_id').text())">Editar</button>
                    @if(isset($user->iduser))

                        <button type="button" class="btn btn-primary" style="color:black" onclick="obrirModalAssistencia($('#eventShow_id').text())">Marcar Assistencia</button>

                        
                    
                    @endif

            </div>
        </div>
    </div>
</div>



<!-- Assistencia Modal -->
<div class="modal" id="assistenciaModal" tabindex="-1" aria-labelledby="assistenciaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assistenciaModalLabel">Signar Assistencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <form action="{{route('calendari.action')}}" method="POST">
                @csrf
                <div class="modal-body row">

                    <div class="col-6">
                
                        <input class="form-label" name="assistenciaModal_id" id="assistenciaModal_id" type="number" hidden>
                        <input class="form-label" name="assistenciaModal_iduser" id="assistenciaModal_iduser" type="number" hidden>
                        
                        <label class="form-label" for="assistenciaModal_name">Nom:</label>
                        <label class="form-label" name="assistenciaModal_name" id="assistenciaModal_name"></label><br>

                        <label class="form-label" for="assistenciaModal_location">Ubicacio:</label>
                        <label class="form-label" name="assistenciaModal_location" id="assistenciaModal_location"></label><br>

                        <label class="form-label" for="assistenciaModal_start_date">Dia Inici:</label>
                        <label class="form-label" name="assistenciaModal_start_date" id="assistenciaModal_start_date"></label><br>

                        <label class="form-label" for="assistenciaModal_start_hour">Hora Inici:</label>
                        <label class="form-label" name="assistenciaModal_start_hour" id="assistenciaModal_start_hour"></label><br>

                    </div>

                    <div class="col-6">

                        <select name="assistenciaModal_assistance" id="assistenciaModal_assistance">
                            @foreach($responses as $response)
                                <option value="{{$response}}">{{$response}}</option>
                            @endforeach
                        </select>

                    </div>
                <input type="hidden" name="type" value="sign">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" style="color:black" data-bs-dismiss="modal">Tanca</button>
                    <button type="submit" class="btn btn-primary" style="color:black">Signar</button>

                </div>
            </form>
        </div>
    </div>
</div>



@endsection

@section('content')
<div class="container">
    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="heigth:70vh">
            <div class="p-6 text-gray-900">

                <div class id="calendar"></div>

            </div>    
        </div>    
    </div>    
</div>    

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
    <script>
        

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        var data = "{{$data}}";
        var jsonUser = "{{$jsonUser}}";
        var membresBanda = "{{$membresBanda}}";
        const regex = /&quot;/ig;


        data = data.replaceAll(regex, '"');
        data = JSON.parse(data);
        //console.log(data);

        
        jsonUser = jsonUser.replaceAll(regex, '"');
        jsonUser = JSON.parse(jsonUser);
        //console.log(jsonUser);

        
        membresBanda = membresBanda.replaceAll(regex, '"');
        membresBanda = JSON.parse(membresBanda);
        //console.log(membresBanda);


        var bandAccess = [];

        if(jsonUser.iduser)
        {
            bandAccess = jsonUser.bands.filter(band => band.role == "Editor");
        }
        else
        {
            bandAccess = [jsonUser];
        }

        if(bandAccess.length == 0)
        {
            $("#btnCrearEvent").hide();
        }



        $(document).ready(function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'local',
                events: data,
                eventDisplay: "block",

                eventClick: function(info){

                    //console.log(info.event);

                    obrirModalShow(info.event.id);
                },
                dateClick: function(info) {

                    //console.log(bandAccess.length == 0);
                            
                    if(bandAccess.length != 0)
                    {
                        obrirModalCrear(info.dateStr);
                    }
                    
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                }
            });

            calendar.render();
        });

        function obrirModalCrear()
        {
            $('#createEventModal').modal('toggle');
            if(jsonUser.idband)
            {
                $("#idband").val(jsonUser.idband);
            }
        }

        function obrirModalCrear(date)
        {
            $('#createEventModal').modal('toggle');
            $("#start_date").val(date);
            $("#start_hour").val("12:00");
            if(jsonUser.idband)
            {
                $("#idband").val(jsonUser.idband);
            }
        }

        function obrirModalShow(id)
        {
            var event = buscarEvent(id);

            if(event)
            {
                var start = new Date(event.start);
                var any = start.getFullYear();
                var mes = start.getMonth().toString().length == 1 ? (start.getMonth() + 1).toString().padStart(2, "0") : (start.getMonth() + 1);
                var dia = start.getDate().toString().length == 1 ? start.getDate().toString().padStart(2, "0") : start.getDate();
                var hour = start.getHours().toString().length == 1 ? start.getHours().toString().padStart(2, "0") : start.getHours();
                var min = start.getMinutes().toString().length == 1 ? start.getMinutes().toString().padStart(2, "0") : start.getMinutes();
                
                var start_date = any + "-" + mes + "-" + dia;
                var start_hour = hour + ":" + min;

                $('#eventShow_start_date').text(start_date);
                $('#eventShow_start_hour').text(start_hour);

                if(event.end)
                {
                    var end = new Date(event.end);
                    var any = end.getFullYear();
                    var mes = end.getMonth().toString().length == 1 ? (end.getMonth() + 1).toString().padStart(2, "0") : (end.getMonth() + 1);
                    var dia = end.getDate().toString().length == 1 ? end.getDate().toString().padStart(2, "0") : end.getDate();
                    var hour = end.getHours().toString().length == 1 ? end.getHours().toString().padStart(2, "0") : end.getHours();
                    var min = end.getMinutes().toString().length == 1 ? end.getMinutes().toString().padStart(2, "0") : end.getMinutes();

                    var end_date = any + "-" + mes + "-" + dia;
                    var end_hour = hour + ":" + min;

                    $('#eventShow_end_date').text(end_date);
                    $('#eventShow_end_hour').text(end_hour);
                    
                }
                
                $('#eventShow').modal('toggle');
                $('#eventShow_id').text(event.id);

                $('#eventShow_name').text(event.name);

                //console.log(event);
                $('#eventShow_location').text(event.location);
                $('#eventShow_description').text(event.description);

                $('#eventShow_band_name').text(event.band_name);

                $('#eventShow_idband').text(event.idband);
                $('#eventShow_status').text(event.status);

                //Pel Checkbox: posar/treure l'atribut checked
                if(event.private)
                {
                    $('#eventShow_private').text("Aquest event es privat");
                }
                else
                {
                    $('#eventShow_private').text("Aquest event es public");
                }

                if(bandAccess.find(band => event.idband == band.idband))
                {
                    $("#btnEditarEvent").show();
                }
                else
                {
                    $("#btnEditarEvent").hide();
                }
            }
        }

        function obrirModalEvent(id)
        {
            $("#eventShow").modal("hide");

            $("#assistenciaBanda").text("");

            event = buscarEvent(id);



            if(event)
            {
                var start = new Date(event.start);
                var any = start.getFullYear();
                var mes = start.getMonth().toString().length == 1 ? (start.getMonth() + 1).toString().padStart(2, "0") : (start.getMonth() + 1);
                var dia = start.getDate().toString().length == 1 ? start.getDate().toString().padStart(2, "0") : start.getDate();
                var hour = start.getHours().toString().length == 1 ? start.getHours().toString().padStart(2, "0") : start.getHours();
                var min = start.getMinutes().toString().length == 1 ? start.getMinutes().toString().padStart(2, "0") : start.getMinutes();
                
                var start_date = any + "-" + mes + "-" + dia;
                var start_hour = hour + ":" + min;

                if(event.end)
                {
                    var end = new Date(event.end);
                    var any = end.getFullYear();
                    var mes = end.getMonth().toString().length == 1 ? (end.getMonth() + 1).toString().padStart(2, "0") : (end.getMonth() + 1);
                    var dia = end.getDate().toString().length == 1 ? end.getDate().toString().padStart(2, "0") : end.getDate();
                    var hour = end.getHours().toString().length == 1 ? end.getHours().toString().padStart(2, "0") : end.getHours();
                    var min = end.getMinutes().toString().length == 1 ? end.getMinutes().toString().padStart(2, "0") : end.getMinutes();
                    
                    var end_date = any + "-" + mes + "-" + dia;
                    var end_hour = hour + ":" + min;

                    $('#eventModal_end_date').val(end_date);
                    $('#eventModal_end_hour').val(end_hour);
                }
                //console.log(start_date);

                $('#eventModal').modal('toggle');
                $('#eventModal_id').val(event.id);
                //$('#eventModal_name').val(event.title);
                $('#eventModal_name').val(event.name);
                $('#eventModal_location').val(event.location);
                $('#eventModal_description').val(event.description);
                $('#eventModal_start_date').val(start_date);
                $('#eventModal_start_hour').val(start_hour);
                if(jsonUser.iduser)
                {
                    $('#eventModal_idband').val(event.idband); // Select bandes
                }
                else
                {
                    $('#eventModal_idband').val(jsonUser.idband);
                }
                
                $('#eventModal_status').val(event.status);

                //Pel Checkbox: posar/treure l'atribut checked

                $('#eventModal_private').prop("checked", event.private);
                
                
                bandAccess.forEach(band => {//Aqui creo cada linia d'assistencia per usuari
                    if(band.idband == event.idband)
                    {
                        membresBanda[band.idband].forEach(us => { //EX: NOM "iduser" | Select Assistencia | Select Instrument

                            var row = '<div class="col-4"><label for="user_name ' + us.iduser + ' "> ' + us.name + ' </label></div><div class="col-4"><select onchange="comprovarAssistencia(' + us.iduser + ')" class="form-control" name="selAssis[' + us.iduser + ']" id="selAssis_' + us.iduser + '"><option value="">Assistencia</option>@foreach($responses as $response) <option value="{{$response}}">{{$response}}</option> @endforeach</select></div><div class="col-4"><select class="form-control" name="selInstr[' + us.iduser + ']" id="selInstr_' + us.iduser + '" style="display:none"><option value="">Instrument</option></select></div>';
                            
                            $("#assistenciaBanda").append(row);
                            //console.log(us.instruments);

                            us.instruments.forEach(ins => {// Per cada usuari de la banda omplo el select amb els intruments que sap tocar

                                var opt = '<option value="' + ins.idinstrument + '">' + ins.name + '</option>';

                                $('#selInstr_' + us.iduser).append(opt);
                                
                            });

                        });


                    }
                });

                if(event.assistance.length > 0)                  //si existeixen registres d'assistencia, modifico les linies dels usuaris 
                {// Per cada usuari de la banda si tenen un registre a la base de dades assigno les respostes corresponents
                    //console.log("assignarAssistenciaInstrument", event.assistance);           

                    event.assistance.forEach(assis =>{
                    //console.log("Assignant", assis);           
                        $('#selAssis_' + assis.user.iduser).val(assis.answer);
                        comprovarAssistencia(assis.user.iduser);

                        if(assis.instrument)
                        {
                            $('#selInstr_' + assis.user.iduser).val(assis.instrument.idinstrument);
                        }

                    });
                }
                
            }
        }

        function comprovarAssistencia(id)
        {// Mostro o amago el select d'instrument en funcio l'assistencia de la gent
            if($('#selAssis_' + id).val() == "Si" || $('#selAssis_' + id).val() == "Si + Transport")
            {
                $('#selInstr_' + id).show();
            }
            else
            {
                $('#selInstr_' + id).hide();
            }
        }

        function obrirModalAssistencia(id)
        {
            $("#eventShow").modal("hide");

            event = buscarEvent(id);



            if(event)
            {
                var start = new Date(event.start);
                var any = start.getFullYear();
                var mes = start.getMonth().toString().length == 1 ? (start.getMonth() + 1).toString().padStart(2, "0") : (start.getMonth() + 1);
                var dia = start.getDate().toString().length == 1 ? start.getDate().toString().padStart(2, "0") : start.getDate();
                var hour = start.getHours().toString().length == 1 ? start.getHours().toString().padStart(2, "0") : start.getHours();
                var min = start.getMinutes().toString().length == 1 ? start.getMinutes().toString().padStart(2, "0") : start.getMinutes();
                
                var start_date = any + "-" + mes + "-" + dia;
                var start_hour = hour + ":" + min;
                console.log(event);

                $('#assistenciaModal').modal('toggle');
                $('#assistenciaModal_id').val(event.id);
                console.log($('#assistenciaModal_id').val());
                $('#assistenciaModal_iduser').val(jsonUser.iduser);
                console.log($('#assistenciaModal_iduser').val());
                //$('#assistenciaModal_name').text(event.title);
                $('#assistenciaModal_name').text(event.name);
                $('#assistenciaModal_location').text(event.location);
                $('#assistenciaModal_start_date').text(start_date);
                $('#assistenciaModal_start_hour').text(start_hour);

                if(event.assistance.length > 0)
                {
                    event.assistance.forEach(assis => {
                        if(assis.user.iduser == jsonUser.iduser)
                        {
                            $('#assistenciaModal_assistance').val(assis.answer);
                        }
                    });
                }

                
            }
        }
        
        // HELPER FUNCTIONS

        function buscarEvent(id)
        {
            var i = 0;
            var trobat = false;

            while(i < data.length && !trobat)
            {
                if(id == data[i].id)
                {
                    trobat = !trobat;
                }
                else
                {
                    i++;
                }
            }

            return trobat ? data[i] : null;
        }





    </script>




























































<!-- 
<script>

    $(document).ready(function () {

        var calendar = $('#calendar').fullCalendar({
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            events:'/calendari',
            selectable:true,
            selectHelper: true,
            select:function(start, end, allDay)
            {
                var title = prompt('Event Title:');

                if(title)
                {
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                    $.ajax({
                        url:"/calendari/action",
                        type:"POST",
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            type: 'add'
                        },
                        success:function(data)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Created Successfully");
                        }
                    })
                }
            },
            editable:true,
            eventResize: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/calendari/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Updated Successfully");
                    }
                })
            },
            eventDrop: function(event, delta)
            {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url:"/calendari/action",
                    type:"POST",
                    data:{
                        title: title,
                        start: start,
                        end: end,
                        id: id,
                        type: 'update'
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Updated Successfully");
                    }
                })
            },

            eventClick:function(event)
            {
                if(confirm("Are you sure you want to remove it?"))
                {
                    var id = event.id;
                    $.ajax({
                        url:"/calendari/action",
                        type:"POST",
                        data:{
                            id:id,
                            type:"delete"
                        },
                        success:function(response)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Deleted Successfully");
                        }
                    })
                }
            }
        });

    });

</script> -->
@endsection
