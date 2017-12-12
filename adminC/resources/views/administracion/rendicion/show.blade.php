@extends ('layouts.admin')
<?php
use Illuminate\Support\Facades\Redirect;
?>

@section ('contenido')
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
                <div class="form-group">
                <label for="fecha">Fecha</label>
                <input class="form-control" name="fecha" id="fecha" value="{{$rendicion->fecha}}"  placeholder="Fecha ..."  readonly>   
            </div>
            <div class="form-group">
                <label for="Empleados_idEmpleados">Empleado</label>
                <input class="form-control" name="Empleados_idEmpleados" id="Empleados_idEmpleados" value="{{$rendicion->nombre}} {{$rendicion->apellido}}"  placeholder="Empleados_idEmpleados ..."  readonly>   
            </div>
            
            <div class="form-group">
                <label for="Colectivos_idColectivos">Colectivo</label>
                <input class="form-control" name="Colectivos_idColectivos" id="Colectivos_idColectivos" value="{{$rendicion->mat}}"  placeholder="Colectivos_idColectivos ..."  readonly>   
            </div>
            
            
            <div class="form-group">
                <label for="recaudacion">Recaudacion</label>
                <input class="form-control" name="recaudacion" id="recaudacion" value="{{$boletera->recaudacion}}"   placeholder="Recaudacion ...">   
            </div>
            <div class="form-group">
                <label for="boletoPrimera">Boleto Primera</label>
                <input class="form-control" name="boletoPrimera" id="boletoPrimera"  value="{{$boletera->boletoPrimera}}" placeholder="Boleto Primera ...">
            </div>
            
            <div class="form-group">
                <label for="beletoSegunda">Beleto Segunda</label>
                <input type="text" name="beletoSegunda" class="form-control" value="{{$boletera->beletoSegunda}}" placeholder="Beleto Segunda ...">       
            </div>
            <div class="form-group">
                <label for="boletoEscolar">Boleto Escolar</label>
                <input class="form-control" name="boletoEscolar" id="boletoEscolar"  value="{{$boletera->boletoEscolar}}" placeholder="Boleto Escolar ...">
            </div>
            <div class="form-group">
                <label for="boletoSecundario">Boleto Secundario</label>
                <input class="form-control" name="boletoSecundario" id="boletoSecundario" value="{{$boletera->boletoSecundario}}"  placeholder="Boleto Secundario ...">
            </div>
            <div class="form-group">
                <label for="boletoJubilado">Boleto Jubilado</label>
                <input class="form-control" name="boletoJubilado" id="boletoJubilado"  value="{{$boletera->boletoJubilado}}" placeholder="Boleto Jubilado ...">
            </div>
            <div class="form-group">
                <label for="boleteoCombinado">Boleto Combinado</label>
                <input class="form-control" name="boleteoCombinado" id="boleteoCombinado" value="{{$boletera->boleteoCombinado}}"  placeholder="Boleto Combinado ...">
            </div>

         
            <div class="form-group">
               
               <a href='{{ URL::previous() }}' ><button  class = "btn btn-default" > Atras</button></a>
                
                
            </div>
         
          
            
        </div>
    </div>

@endsection