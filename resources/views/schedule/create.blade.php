@extends('layouts.app')
@section('content')
    <div class="container">
        <div id="schedule"></div>
    </div>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#evento">
        Launch
    </button>

    <!-- Modal -->
    <div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="formulario1">

                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label for="title">Titulo</label>
                            <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId"
                                placeholder="Escribe tu cita aqui">
                        </div>

                        <div class="form-group">
                            <label for="start">Start</label>
                            <input type="date" class="form-control" name="start" id="start" aria-describedby="helpId"
                                placeholder="">

                        </div>

                        <div class="form-group">
                            <label for="end">end</label>
                            <input type="date" class="form-control" name="end" id="end" aria-describedby="helpId"
                                placeholder="">

                        </div>

                        <div class="form-group">
                            <label for="vet_id">Veterinario</label>
                            <select name="vet_id" class="form-control">
                                @foreach ($vets as $vet)
                                    <option value="{{ $vet->id }}">{{ $vet->name }}</option>
                                @endforeach

                            </select>

                        </div>

                        <div class="form-group">

                            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">

                            <input type="hidden" id="id" name="id" value="">
                        </div>



                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
                    <button type="button" class="btn btn-warning" id="btnModificar">Modificar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let formulario = document.getElementById('formulario1');

            var calendarEl = document.getElementById('schedule');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: "es",

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },

                events: "http://localhost/laravel/prueba-medicatel/public/cita/mostrar",


                dateClick: function(info) {
                    formulario.reset();
                    formulario.start.value = info.dateStr;
                    formulario.end.value = info.dateStr;

                    $('#evento').modal("show");
                },

                eventClick: function(info) {
                    var evento = info.event;

                    axios.post("http://localhost/laravel/prueba-medicatel/public/cita/editar/"+info.event.id).
                    then(
                        (respuesta) => {
                            formulario.id.value = respuesta.data.id;
                            console.log(formulario.id.value);
                            formulario.title.value = respuesta.data.title;
                            formulario.start.value = respuesta.data.start;
                            formulario.end.value = respuesta.data.end;
                            formulario.user_id.value = respuesta.data.user_id;
                            console.log(formulario.user_id.value);
                            $("#evento").modal("show");
                        }
                    ).catch(
                        error => {
                            if (error.response) {
                                console.log(error.response.data);
                            }
                        }
                    );
                }
            });

            calendar.render();

            document.getElementById("btnGuardar").addEventListener("click", function() {
                enviarDatos("http://localhost/laravel/prueba-medicatel/public/cita/crear");
            });

            document.getElementById("btnModificar").addEventListener("click", function() {
                enviarDatos("http://localhost/laravel/prueba-medicatel/public/cita/actualizar/"+formulario.id.value);
            });


            function enviarDatos(url){
                const datos = new FormData(formulario);

                axios.post(url, datos).
                then(
                    (respuesta) => {
                        calendar.refetchEvents();
                        $("#evento").modal("hide");
                    }
                ).catch(
                    error => {
                        if (error.response) {
                            console.log(error.response.data);
                        }
                    }
                );
            }

        });
    </script>
@endsection
