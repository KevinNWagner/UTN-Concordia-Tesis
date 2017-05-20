@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
            <h3>Nueva Cartelera</h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{$err}}</li>
                    @endforeach
                </ul>

            </div>
            @endif
            
            {!!Form::open(array('url'=>'administracion/cartelera','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
             <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input class="form-control" name="descripcion" id="descripcion"  placeholder="Descripcion ...">   
            </div>
            <div class="form-group">
                <label for="horaInicio">Hora de Inicio</label>
                <input class="form-control" name="horaInicio" id="horaInicio"  data-default="20:48" placeholder="Hora de Inicio ...">   
            </div>
            <div class="form-group">
                <label for="horaFin">Hora del Fin</label>
                <input class="form-control" name="horaFin" id="horaFin"  data-default="20:48" placeholder="Hora del fin ...">
            </div>
            
            <div class="form-group">
                <label for="cantidadPersonas">Cantidad de personas</label>
                <input type="text" name="cantidadPersonas" class="form-control" placeholder="Cantidad de personas ...">       
            </div>
            <div class="form-group">
                <label for="duracionRecorrido">Duracion del Recorrido</label>
                <input class="form-control" name="duracionRecorrido" id="duracionRecorrido"  data-default="20:48" placeholder="Duracion del recorrido ...">
            </div>
         
            <div class="form-group">
                <button class = "btn btn-primary" type="submit"> Guardar</button>
                <button class = "btn btn-danger" type="reset"> Cancelar</button>                
                
                
            </div>
            <script>
            var horaInicio = $('#horaInicio');
                horaInicio.clockpicker({
                autoclose: true
            });
             var horaFin = $('#horaFin');
                horaFin.clockpicker({
                autoclose: true
            });
                var horaFin = $('#duracionRecorrido');
                horaFin.clockpicker({
                autoclose: true
            });
            </script>
            {!!Form::close()!!}
            
        </div>
    </div>

@endsection