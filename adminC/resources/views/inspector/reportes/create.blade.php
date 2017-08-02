@extends ('layouts.inspector')
@section ('contenido')
    <div class="row">
       @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{$err}}</li>
                    @endforeach
                </ul>

            </div>
            @endif
        <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
       
            <h3>Nuevo Reporte</h3>
        
            {!!Form::open(array('url'=>'inspector/reportes','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input class="form-control" name="desc" id="desc"   placeholder="Descripción ...">   
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input class="form-control" name="fecha" id="fecha"  placeholder="Fecha ...">
            </div>
            
            

            <div class="form-group">
                <label for="colectivo">Colectivo</label>
                <select name="colectivo" id="colectivo" class="form-control">  
                @foreach($colectivo as $car)
                    <option value="{{$car->idColectivos}}" >{{$car->matricula}}</option>
                @endforeach               
                </select>
            </div>

            <div class="form-group">
                <label for="chofer">Chofer</label>
                <select name="chofer" id="chofer" class="form-control">  
                @foreach($chofer as $car)
                    <option value="{{$car->idEmpleados}}" >{{$car->nombre}}</option>
                @endforeach               
                </select>
            </div>

            
            <div class="form-group">
                <button class = "btn btn-primary" type="submit"> Guardar</button>
                <button class = "btn btn-danger" type="reset"> Cancelar</button>                
                
                
            </div>
           <script>
            $(document).ready(function(){
            $.fn.datepicker.defaults.language = 'es';
            });
            $(document).ready(function(){
                var date_input=$('input[name="fecha"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                    date_input.datepicker({
                        format: 'dd-mm-yyyy',
                        container: container,
                        todayHighlight: true,
                        autoclose: true,
                    })
            });
            </script>
            {!!Form::close()!!}
            
        </div>
        

    </div>

@endsection