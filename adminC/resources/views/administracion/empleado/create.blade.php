@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
            <h3>Nuevo empleado</h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{$err}}</li>
                    @endforeach
                </ul>

            </div>
            @endif
            {!!Form::open(array('url'=>'administracion/empleado','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="form-group">
                <label for="nombre"> Nombre </label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre ...">       
            </div>
            <div class="form-group">
                <label for="apellido"> Apellido </label>
                <input type="text" name="apellido" class="form-control" placeholder="apellido ...">       
            </div>
            <div class="form-group">
                <label for="domicilio"> Domicilio </label>
                <input type="text" name="domicilio" class="form-control" placeholder="Domicilio ...">       
            </div>
            <div class="form-group">
                <label for="telefono"> Telefono </label>
                <input type="text" name="telefono" class="form-control" placeholder="Telefono ...">       
            </div>
            <div class="form-group">
                <label for="celular"> Celular </label>
                <input class="form-control" id="celular" name="celular" placeholder="Celular ..." type="text"/>

            </div>                            
        <div class="form-group ">
      <label for="fechaNacimiento">
       Fecha de Nacimiento       
      </label>     
        <input class="form-control" id="fechaNacimiento" name="fechaNacimiento" placeholder="DD-MM-YYYY" type="text"/>
       </div>    
            <div class="form-group">
                <label for="fechaAntiguedad"> Fecha de Antiguedad </label>
                <input class="form-control" id="fechaAntiguedad" name="fechaAntiguedad" placeholder="DD-MM-YYYY" type="text"/>
            </div>
            <div class="form-group">
                <label for="turno"> Turno </label>
                <select name="idturno" id="idturno" class="form-control">                
                    <option value="1" >Mañana</option>    
                    <option value="2" >Noche</option>    
                </select>
            </div>
              <div class="form-group">
                <label for="usuario"> Usuario </label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Usuario ...">       
            </div>
              <div class="form-group">
                <label for="contraseña"> Contraseña </label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña ...">       
            
         </div>
   
         <div class="form-group">
            <label for="password-confirm" >Confirme Contraseña</label>
           
                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="Contraseña ...">                
        </div>
            <div class="form-group">
                <label for="contraseña">Tipo</label>
                <select name="idtipo" id="idtipo" class="form-control">  
                @foreach($tipos as $tip)
                    <option value="{{$tip->idTipos}}" >{{$tip->Nombre}}</option>
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
                })
            </script>

            {!!Form::close()!!}
            
            
        </div>
    </div>

@endsection