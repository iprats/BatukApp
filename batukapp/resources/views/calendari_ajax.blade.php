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
            <div class="modal-body row">

                <div class="col-6">
                
                    <label class="form-label" for="eventModal_name">Nom:</label>
                    <input class="form-control" name="eventModal_name" id="eventModal_name" required><br>

                    <label class="form-label" for="eventModal_location">Ubicacio:</label>
                    <input class="form-control" name="eventModal_location" id="eventModal_location" required><br>

                    <label class="form-label" for="eventModal_start_date">Dia Inici:</label>
                    <input type="date"class="form-control" name="eventModal_start_date" id="eventModal_start_date" required><br>

                    <label class="form-label" for="eventModal_start_hour">Hora Inici:</label>
                    <input type="time" class="form-control" name="eventModal_start_hour" id="eventModal_start_hour" required><br>

                    <label class="form-label" for="eventModal_status">Estat:</label>
                    <select class="form-control" name="eventModal_status" id="eventModal_status" required>
                        @foreach($statuses as $status)
                            <option value="{{$status}}">{{$status}}</option>
                        @endforeach
                    </select>
                    <br>

                    <input class="form-control" type="checkbox" checked name="eventModal_private" id="eventModal_private" required>
                    <label class="form-label" for="eventModal_private">Privat</label><br>

                </div>

                <div class="col-6">
                @if(isset($user->idband))
                    <label class="form-label" for="eventModal_idband">Banda:</label>
                    <select class="form-control" name="eventModal_idband" id="eventModal_idband" required>
                        <option value="{{$user->idband}}">{{$user->name}}</option>

                    </select>
                    <br>
                @else
                    <label class="form-label" for="eventModal_idband">Banda:</label>
                    <select class="form-control" name="eventModal_idband" id="eventModal_idband" required>
                        @foreach($user->bands as $band)
                        @if($band->role == "Editor")
                            <option value="{{$band->idband}}">{{$band->name}}</option>
                        @endif
                        @endforeach

                    </select>
                    <br>
                @endif

                    <label class="form-label" for="eventModal_description">Descripcio:</label>
                    <input class="form-control" name="eventModal_description" id="eventModal_description"><br>

                    <label class="form-label" for="eventModal_end_date">Dia Final:</label>
                    <input type="date"class="form-control" name="eventModal_end_date" id="eventModal_end_date"><br>

                    <label class="form-label" for="eventModal_end_hour">Hora Final:</label>
                    <input type="time" class="form-control" name="eventModal_end_hour" id="eventModal_end_hour"><br>

                    <!-- <label class="form-label" for="eventModal_main_photo" >Imatge principal:</label>
                    <input type="file" class="form-control" name="eventModal_main_photo" id="eventModal_main_photo"><br> -->

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" style="color:black" data-bs-dismiss="modal">Tanca</button>
                <button type="button" class="btn btn-warning" onclick="enviarEvent('eventModal_', 'update')">Guardar Canvis</button>

            </div>
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
            <form action="{{route('calendari.action')}}" id="ajax-form">
                <div class="modal-body row">

                    <div class="col-6">
                    
                        <label class="form-label" for="name">Nom:</label>
                        <input class="form-control" name="name" id="name" required><br>

                        <label class="form-label" for="location">Ubicacio:</label>
                        <input class="form-control" name="location" id="location" required><br>

                        <label class="form-label" for="start_date">Dia Inici:</label>
                        <input type="date"class="form-control" name="start_date" id="start_date" required><br>

                        <label class="form-label" for="start_hour">Hora Inici:</label>
                        <input type="time" class="form-control" name="start_hour" id="start_hour" required><br>

                        <label class="form-label" for="status">Estat:</label>
                        <select class="form-control" name="status" id="status" required>
                            @foreach($statuses as $status)
                                <option value="{{$status}}">{{$status}}</option>
                            @endforeach
                        </select>
                        <br>

                        <input class="form-control" type="checkbox" checked name="private" id="private" required>
                        <label class="form-label" for="private">Privat</label><br>

                    </div>

                    <div class="col-6">
                    @if(isset($user->idband))
                        <label class="form-label" for="idband">Banda:</label>
                        <select class="form-control" name="idband" id="idband" required>
                            <option value="{{$user->idband}}">{{$user->name}}</option>

                        </select>
                        <br>
                    @else
                        <label class="form-label" for="idband">Banda:</label>
                        <select class="form-control" name="idband" id="idband" required>
                            @foreach($user->bands as $band)
                            @if($band->role == "Editor")
                                <option value="{{$band->idband}}">{{$band->name}}</option>
                            @endif
                            @endforeach

                        </select>
                        <br>
                    @endif

                        <label class="form-label" for="description">Descripcio:</label>
                        <input class="form-control" name="description" id="description"><br>

                        <label class="form-label" for="end_date">Dia Final:</label>
                        <input type="date"class="form-control" name="end_date" id="end_date"><br>

                        <label class="form-label" for="end_hour">Hora Final:</label>
                        <input type="time" class="form-control" name="end_hour" id="end_hour"><br>

                        <!-- <label class="form-label" for="main_photo" >Imatge principal:</label>
                        <input type="file" class="form-control" name="main_photo" id="main_photo"><br> -->

                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" style="color:black" data-bs-dismiss="modal">Tancar</button>
                    <button type="submit" class="btn btn-warning">Crear</button>
                    <!-- onclick="enviarEvent('', 'add')"  -->

                </div>
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
                    <label class="form-label" name="eventShow_idband" id="eventShow_idband"></label><br>
                @endif

                    <label class="form-label" for="eventShow_description">Descripcio:</label>
                    <label class="form-label" name="eventShow_description" id="eventShow_description"></label><br>

                    <label class="form-label" for="eventShow_end_date">Dia Final:</label>
                    <label class="form-label" name="eventShow_end_date" id="eventShow_end_date"></label><br>

                    <label class="form-label" for="eventShow_end_hour">Hora Final:</label>
                    <label class="form-label" name="eventShow_end_hour" id="eventShow_end_hour"></label><br>

                    <!-- <label class="form-label" for="eventShow_main_photo" >Imatge principal:</label>
                    <input class="form-label" name="eventShow_main_photo" id="eventShow_main_photo"><br> -->

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" style="color:black" data-bs-dismiss="modal">Tancar</button>

                <!-- NOMES PER EDITORS I BANDES -->
                <button type="button" class="btn btn-warning" id="btnEditarEvent" onclick="obrirModalEvent($('#eventShow_idband').text())">Editar</button>

            </div>
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
        const regex = /&quot;/ig;
        data = data.replaceAll(regex, '"');
        data = JSON.parse(data);
        console.log(data);

        
        jsonUser = jsonUser.replaceAll(regex, '"');
        jsonUser = JSON.parse(jsonUser);
        console.log(jsonUser);


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
                events: '/calendari',

                eventClick: function(info){

                    obrirModalShow(info.event.id);
                },
                dateClick: function(info) {

                    console.log(bandAccess.length == 0);
                            
                    if(bandAccess.length != 0)
                    {
                        obrirModalCrear(info.dateStr);
                    }
                    
                }
            });

            calendar.render();
        });

        function obrirModalCrear()
        {
            if(this)
            {
                this.modal("toggle");
            }
            $('#createEventModal').modal('toggle');
        }

        function obrirModalCrear(date)
        {
            $('#createEventModal').modal('toggle');
            $("#start_date").val(date);
            $("#start_hour").val("12:00");
        }

        function obrirModalShow(id)
        {
            var event = buscarEvent(id);

            var camps = ["eventShow","eventShow_name","eventShow_location","eventShow_description","eventShow_start_date","eventShow_start_hour","eventShow_end_date","eventShow_end_hour","eventShow_idband","eventShow_status","eventShow_private"]

            if(event)
            {
                var start = new Date(event.start);
                var any = start.getFullYear();
                var mes = start.getMonth().toString().length == 1 ? start.getMonth().toString().padStart(2, "0") : start.getMonth();
                var dia = start.getDate().toString().length == 1 ? start.getDate().toString().padStart(2, "0") : start.getDate();
                var hour = start.getHours().toString().length == 1 ? start.getHours().toString().padStart(2, "0") : start.getHours();
                var min = start.getMinutes().toString().length == 1 ? start.getMinutes().toString().padStart(2, "0") : start.getMinutes();
                
                var start_date = any + "-" + mes + "-" + dia;
                var start_hour = hour + ":" + min;

                if(event.end)
                {
                    var end = new Date(event.end);
                    var any = end.getFullYear();
                    var mes = end.getMonth().toString().length == 1 ? end.getMonth().toString().padStart(2, "0") : end.getMonth();
                    var dia = end.getDate().toString().length == 1 ? end.getDate().toString().padStart(2, "0") : end.getDate();
                    var hour = end.getHours().toString().length == 1 ? end.getHours().toString().padStart(2, "0") : end.getHours();
                    var min = end.getMinutes().toString().length == 1 ? end.getMinutes().toString().padStart(2, "0") : end.getMinutes();

                    var end_date = any + "-" + mes + "-" + dia;
                    var end_hour = hour + ":" + min;
                }
                
                //console.log(start_date);

                $('#eventShow').modal('toggle');
                $('#eventShow_name').text(event.title);
                $('#eventShow_location').text(event.location);
                $('#eventShow_description').text(event.description);
                $('#eventShow_start_date').text(start_date);
                $('#eventShow_start_hour').text(start_hour);

                if(event.end)
                {
                    $('#eventShow_end_date').text(end_date);
                    $('#eventShow_end_hour').text(end_hour);
                }


                //Pels selects: foreach selectOption buscar quin value es igual a la id
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

            event = buscarEvent(id);

            if(event)
            {
                var start = new Date(event.start);
                var any = start.getFullYear();
                var mes = start.getMonth().toString().length == 1 ? start.getMonth().toString().padStart(2, "0") : start.getMonth();
                var dia = start.getDate().toString().length == 1 ? start.getDate().toString().padStart(2, "0") : start.getDate();
                var hour = start.getHours().toString().length == 1 ? start.getHours().toString().padStart(2, "0") : start.getHours();
                var min = start.getMinutes().toString().length == 1 ? start.getMinutes().toString().padStart(2, "0") : start.getMinutes();
                
                var start_date = any + "-" + mes + "-" + dia;
                var start_hour = hour + ":" + min;

                if(event.end)
                {
                    var end = new Date(event.end);
                    var any = end.getFullYear();
                    var mes = end.getMonth().toString().length == 1 ? end.getMonth().toString().padStart(2, "0") : end.getMonth();
                    var dia = end.getDate().toString().length == 1 ? end.getDate().toString().padStart(2, "0") : end.getDate();
                    var hour = end.getHours().toString().length == 1 ? end.getHours().toString().padStart(2, "0") : end.getHours();
                    var min = end.getMinutes().toString().length == 1 ? end.getMinutes().toString().padStart(2, "0") : end.getMinutes();
                    
                    var end_date = any + "-" + mes + "-" + dia;
                    var end_hour = hour + ":" + min;
                }
                //console.log(start_date);

                $('#eventModal').modal('toggle');
                $('#eventModal_name').val(event.title);
                $('#eventModal_location').val(event.location);
                $('#eventModal_description').val(event.description);
                $('#eventModal_start_date').val(start_date);
                $('#eventModal_start_hour').val(start_hour);

                if(event.end)
                {
                    $('#eventModal_end_date').val(end_date);
                    $('#eventModal_end_hour').val(end_hour);
                }

                //Pels selects: foreach selectOption buscar quin value es igual a la id
                // $('#eventModal_idband').val();
                // $('#eventModal_status').val();

                //Pel Checkbox: posar/treure l'atribut checked
                // $('#eventModal_private').css();

                
            }
        }

        function enviarEvent(origen, action)
        {
            var enviar = true;





            var title = $('#'+ origen + 'name').val();

            if(title != null && title != "" && enviar)
            {
                console.log("title", title);
                console.log("title", enviar);
            }
            else
            {
                enviar = false;
            }

            var location = $('#'+ origen + 'location').val();

            if(location != null && location != "" && enviar)
            {
                console.log("location", location);
                console.log("location", enviar);
            }

            var description = $('#'+ origen + 'description').val();

            if(description != null && description != "" && enviar)
            {
                console.log("description", description);
                console.log("description", enviar);
            }

            var startDate = $('#'+ origen + 'start_date').val();

            if(startDate != null && startDate != "" && enviar)
            {
                console.log("startDate", startDate);
                console.log("startDate", enviar);
            }
            else
            {
                enviar = false;
            }

            var startHour = $('#'+ origen + 'start_hour').val();

            if(startHour != null && startHour != "" && enviar)
            {
                console.log("startHour", startHour);
                console.log("startHour", enviar);
            }
            else
            {
                enviar = false;
            }

            var endDate = $('#'+ origen + 'end_date').val();

            if(endDate != null && endDate != "" && enviar)
            {
                console.log("endDate", endDate);
                console.log("endDate", enviar);
            }

            var endHour = $('#'+ origen + 'end_hour').val();

            if(endHour != null && endHour != "" && enviar)
            {
                console.log("endHour", endHour);
                console.log("endHour", enviar);
            }

            var idband = $('#'+ origen + 'idband').val();

            if(idband != null && idband != "" && enviar)
            {
                console.log("idband", idband);
                console.log("idband", enviar);
            }
            else
            {
                enviar = false;
            }

            var status = $('#'+ origen + 'status').val();

            if(status != null && status != "" && enviar)
            {
                console.log("status", status);
                console.log("status", enviar);
            }

            var private = $('#'+ origen + 'private').val();

            if(private != null && private != "" && enviar)
            {
                private = true;

                console.log("private", private);
                console.log("private", enviar);
            }
            else
            {
                enviar = false;
            }

            console.log(title, "/", location, "/", description, "/", startDate, "/", startHour, "/", endDate, "/", endHour, "/", idband, "/", status, "/", private);

            //Parse dates
            var start_date = new Date();
            var end_date;

            if(enviar)
            {
                data = {
                        title: title,
                        idband: idband,
                        location: location,
                        start_date: start_date,
                        end_date: end_date,
                        description: description,
                        status: status,
                        private: private,
                        // main_photo: main_photo,

                        type: action
                    }
                $.ajax({
                    url:"{{route('calendari.action')}}",
                    type:"POST",
                    data:{
                        title: title,
                        idband: idband,
                        location: location,
                        start_date: start_date,
                        end_date: end_date,
                        description: description,
                        status: status,
                        private: private,
                        // main_photo: main_photo,

                        type: action
                    },
                    success:function(data)
                    {
                        console.log(data);
                        calendar.fullCalendar('refetchEvents');
                        alert("Event Created Successfully");
                    }
                });
                return data;
                console.log("ENVIAO");
                console.log(action);
                console.log(data);
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

        
        $('#ajax-form').submit(function(e) {
            e.preventDefault();

            var data_ = enviarEvent("modalEvent_", "add");


        
            console.log("preventSubmit");    
            $.ajax({
                url:"{{route('calendari.action')}}",
                type:"POST",
                dataType: 'JSON',
                data:data_,
                success:function(data)
                {
                    console.log(data);
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Created Successfully");
                },
                error: function(response){
                    $('#ajax-form').find(".print-error-msg").find("ul").html('');
                    $('#ajax-form').find(".print-error-msg").css('display','block');
                    $.each( response.responseJSON.errors, function( key, value ) {
                        $('#ajax-form').find(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                    });
                }
            });
        
        });




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
