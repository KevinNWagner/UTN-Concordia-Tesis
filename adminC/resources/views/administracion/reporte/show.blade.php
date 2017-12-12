@extends ('layouts.admin')
<?php
use Illuminate\Support\Facades\Redirect;
?>

@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
            <h3>Inspector {{ $reportes->ApellidoI}} {{ $reportes->NombreI}}  </h3>
            <h4>Reporte:  </h4>
            
           
            
         

             <div class="form-group">
                <label for="nombre"> Chofer: </label>
                <label >{{ $reportes->ApellidoC}} {{ $reportes->NombreC}}</label>    
            </div>
            <div class="form-group">
                <label for="nombre"> Fecha: </label>
                <label > {{DateTime::createFromFormat('Y-m-d',$reportes->fecha)->format('d-m-Y')}}</label>    
            </div>
            <div class="form-group">
                <label for="nombre"> Colectivo: </label>
                <label >{{ $reportes->matricula}}</label>    
            </div>
            <div class="form-group">
                <label for="nombre"> Descripcion: </label>
                <label >{{ $reportes->descripcion}}</label>    
            </div>

         
          
            
        </div>
    </div>

@endsection