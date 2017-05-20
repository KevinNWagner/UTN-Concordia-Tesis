@extends ('layouts.admin')
<?php
use Illuminate\Support\Facades\Redirect;
?>

@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
            <h3>Empleado {{ $empleado->apellido}} {{ $empleado->nombre}}  </h3>
           
            
           
            
         

             <div class="form-group">
                <label for="nombre"> Nombre: </label>
                <label >{{ $empleado->nombre}}</label>    
            </div>
            <div class="form-group">
                <label for="apellido"> Apellido: </label>
               <label >{{ $empleado->apellido}}</label>        
            </div>
            <div class="form-group">
                <label for="domicilio"> Domicilio: </label>
                <label >{{ $empleado->domicilio}}</label>  
            </div>
            <div class="form-group">
                <label for="telefono"> Telefono: </label>
                <label >{{ $empleado->telefono}}</label>        
            </div>
            <div class="form-group">
                <label for="celular"> Celular: </label>
                <label >{{ $empleado->celular}}</label>     
            </div>
            <div class="form-group">
                <label for="fechaNacimiento"> Fecha  de Nacimiento: </label>
                <label >{{ DateTime::createFromFormat('Y-m-d', $empleado->fechaNacimiento)->format('d-m-Y')}}</label>  
            </div>
            <div class="form-group">
                <label for="fechaAntiguedad"> Fecha de Antiguedad: </label>
                <label >{{ DateTime::createFromFormat('Y-m-d', $empleado->fechaAntiguedad)->format('d-m-Y')}}</label>  
            </div>
            <div class="form-group">
                <label for="turno"> Turno: </label>
                <label >
                @if($empleado->turno===1)
                    Mañana
                @else
                    Noche
                @endif
                </label>  
            </div>
              <div class="form-group">
                <label for="usuario"> Usuario: </label>
                <label >{{ $empleado->usuario}}</label>     
            </div>
              <div class="form-group">
                <label for="contraseña"> Contraseña: </label>
                <label >{{ $empleado->contraseña}}</label>  
            </div>
              <div class="form-group">
                <label for="Tipos_idTurnos">Tipo: </label>                  
                <label >
                    @foreach($tipos as $tip)
                    @if($tip->idTipos===$empleado->Tipos_idTipos)
                        {{$tip->Nombre}}
                    @endif
                    @endforeach
                </label>  
            </div>
         
            <div class="form-group">
               
               <a href='{{ URL::previous() }}' ><button  class = "btn btn-default" > Atras</button></a>
                
                
            </div>
         
          
            
        </div>
    </div>

@endsection