@extends ('layouts.admin')
<?php
use Illuminate\Support\Facades\Redirect;

?>

@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
            <h3>Editar empleado:{{ $empleado->Nombre}} </h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{$err}}</li>
                    @endforeach
                </ul>

            </div>
            @endif
            
            {!!Form::model($empleado,['method'=>'PATCH','action' => array('EmpleadoController@update', $empleado->idEmpleados, $user->id)])!!}
            
            {{Form::token()}}

             <div class="form-group">
             {{$user->id}}
                <label for="nombre"> Nombre </label>
                <input type="text" name="nombre" value="{{ $empleado->nombre}}"  class="form-control" placeholder="Nombre ...">       
            </div>
            <div class="form-group">
                <label for="apellido"> Apellido </label>
                <input type="text" name="apellido" value="{{ $empleado->apellido}}" class="form-control" placeholder="apellido ...">       
            </div>
            <div class="form-group">
                <label for="domicilio"> Domicilio </label>
                <input type="text" name="domicilio" value="{{ $empleado->domicilio}}" class="form-control" placeholder="Domicilio ...">       
            </div>
            <div class="form-group">
                <label for="telefono"> Telefono </label>
                <input type="text" name="telefono" value="{{ $empleado->telefono}}" class="form-control" placeholder="Telefono ...">       
            </div>
            <div class="form-group">
                <label for="celular"> Celular </label>
                <input type="text" name="celular" value="{{ $empleado->celular}}" class="form-control" placeholder="Celular ...">       
            </div>
            <div class="form-group">
                <label for="fechaNacimiento"> Fecha  de Nacimiento </label>
                    <input type="text" name="fechaNacimiento" value="{{ DateTime::createFromFormat('Y-m-d', $empleado->fechaNacimiento)->format('d-m-Y')}}" class="form-control" placeholder="Fecha de Antiguedad ...">     

            </div>
            <div class="form-group">
                <label for="fechaAntiguedad"> Fecha de Antiguedad </label>
                <input type="text" name="fechaAntiguedad" value="{{ DateTime::createFromFormat('Y-m-d', $empleado->fechaAntiguedad)->format('d-m-Y')}}" class="form-control" placeholder="Fecha de Antiguedad ...">       
            </div>
            <div class="form-group">
                <label for="turno"> Turno </label>
                <select name="idturno" id="idturno" class="form-control">                
                    @if($empleado->turno===1)
                    <option value="1" selected="selected"  >Mañana</option>  
                    <option value="2"  >Noche</option>    
                    @else
                    <option value="1"   >Mañana</option>  
                    <option value="2" selected="selected" >Noche</option>    
                    @endif
                    
                </select>   
            </div>
              <div class="form-group">
                <label for="usuario"> Usuario </label>
                <input type="text" name="name" id="name"  class="form-control" value="{{$empleado->name}}" placeholder="Usuario ...">       
            </div>
              <div class="form-group">
                <label for="contraseña"> Contraseña : <font color="red"> * Si desea cambiarla ingrese una nueva contraseña </font></label>
                <input type="password" name="password" value="" id="password" class="form-control" placeholder="Contraseña ...">       
            
         </div>
   
         <div class="form-group">
            <label for="password-confirm" >Confirme Contraseña</label>
           
                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="Contraseña ...">       
       </div>
        <div class="form-group">
                <label for="contraseña">Tipo</label>
                
                
                <select name="idtipo" id="idtipo" class="form-control">  
                @foreach($tipos as $tip)
                    @if($tip->idTipos === $user->Tipos_idTipos)
                        <option value="{{$tip->idTipos}}" selected="selected">{{$tip->Nombre}}</option>
                    @else
                        <option value="{{$tip->idTipos}}" >{{$tip->Nombre}}</option>           
                    @endif
                @endforeach
                
                
                </select>
            </div>
         
            <div class="form-group">
                <button class = "btn btn-primary" type="submit"> Guardar</button>
                <a href='{{ URL::previous() }}' /><button class = "btn btn-default" > Cancelar</button> </a>
                
                
            </div>
          <script>
            $(document).ready(function(){
            $.fn.datepicker.defaults.language = 'es';
            });
            $(document).ready(function(){
                var date_input=$('input[name="fechaAntiguedad"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                    date_input.datepicker({
                        format: 'dd-mm-yyyy',
                        container: container,
                        todayHighlight: true,
                        autoclose: true,
                    })
              
            var date_input=$('input[name="fechaNacimiento"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                    date_input.datepicker({
                        format: 'dd-mm-yyyy',
                        container: container,
                        todayHighlight: true,
                        autoclose: true,
                        lenguage:'es'
                    })
                });
            </script>
            {!!Form::close()!!}
            
        </div>
    </div>

@endsection