@extends('layouts.app')
@section('content')
    <div class="container">
        <div id="schedule">calendario</div>
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
                    <form action="">

                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label for="title">Titulo</label>
                            <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId"
                                placeholder="Escribe tu cita aqui">
                        </div>

                        <div class="form-group">
                            <label for="start">Start</label>
                            <input type="text" class="form-control" name="start" id="start" aria-describedby="helpId"
                                placeholder="">

                        </div>

                        <div class="form-group">
                            <label for="end">end</label>
                            <input type="text" class="form-control" name="end" id="end" aria-describedby="helpId"
                                placeholder="">

                        </div>

                        <div class="form-group">
                            <label for="vet_id">Veterinario</label>
                            <select name="vet_id" class="form-control">
                                @foreach ($vets as $vet )
                                   <option value="{{ $vet->id }}">{{ $vet->name }}</option> 
                                @endforeach
                                
                              </select>
                              
                        </div>

                    </form>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-success" id="btnGuardar">Guardar</button>
                    <button type="button" class="btn btn-warning" id="btnModificar">Modificar</button>
                    <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let formulario = document.querySelector("form");

            var calendarEl = document.getElementById('schedule');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: "es",

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },

                dateClick: function(info) {
                    $('#evento').modal("show");
                }
            });

            calendar.render();

            document.getElementById("btnGuardar").addEventListener("click",function(){
                const datos = new FormData(formulario);
                
                axios.post("http://veterinaria.com.devel/cita/crear", datos).
                then(
                    (respuesta)=>{
                        $("#evento").modal("hide");
                    }
                    ).catch(
                        error=>{
                            if(error.response){
                                console.log(error.response.data);
                            }
                        }
                    );
            });
        });
    </script>
@endsection
