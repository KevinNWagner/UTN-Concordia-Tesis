@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
            <h3>Nueva Cronograma</h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{$err}}</li>
                    @endforeach
                </ul>

            </div>
            @endif
            
            {!!Form::open(array('url'=>'administracion/cronograma','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
             <div class="form-group">
                <label for="descripcion">Fecha</label>
                <input class="form-control" name="fecha" id="fecha"  value="{{date('d-m-Y')}}">   
            </div>
            <div class="form-group">
                <label for="cartelera">Cartelera</label>
                <select name="Carteleras_idCarteleras" id="Carteleras_idCarteleras" class="form-control">  
                @foreach($carteleras as $car)
                    <option value="{{$car->idCarteleras}}" >{{$car->descripcion}}</option>
                @endforeach               
                </select>
            </div>
            
         
            <div class="form-group">
                <button class = "btn btn-success" type="submit">Siguiente</button>
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