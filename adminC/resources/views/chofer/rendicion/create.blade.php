@extends ('layouts.chofer')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
        @if($designacion)
            <h3>Nueva Rendicion</h3>
        @else
          <h3>Hoy, no estuvo en ningún cronograma.</h3>
        @endif    
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{$err}}</li>
                    @endforeach
                </ul>

            </div>
            @endif
            
            @if($designacion)
            {!!Form::open(array('url'=>'chofer/rendicion','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
             <div class="form-group">
                <label for="fecha">Fecha</label>
                <input class="form-control" name="fecha" id="fecha" value="{{$designacion->fecha}}"  placeholder="Fecha ..."  readonly>   
            </div>
            <div class="form-group">
                <label for="Empleados_idEmpleados">Empleado</label>
                <input class="form-control" name="Empleados_idEmpleados" id="Empleados_idEmpleados" value="{{$designacion->Empleados_idEmpleados}}"  placeholder="Empleados_idEmpleados ..."  readonly>   
            </div>
            
            <div class="form-group">
                <label for="Colectivos_idColectivos">Colectivo</label>
                <input class="form-control" name="Colectivos_idColectivos" id="Colectivos_idColectivos" value="{{$designacion->Colectivos_idColectivos}}"  placeholder="Colectivos_idColectivos ..."  readonly>   
            </div>
            
            
            <div class="form-group">
                <label for="recaudacion">Recaudacion</label>
                <input class="form-control" name="recaudacion" id="recaudacion"   placeholder="Recaudacion ...">   
            </div>
            <div class="form-group">
                <label for="boletoPrimera">Boleto Primera</label>
                <input class="form-control" name="boletoPrimera" id="boletoPrimera"  placeholder="Boleto Primera ...">
            </div>
            
            <div class="form-group">
                <label for="beletoSegunda">Beleto Segunda</label>
                <input type="text" name="beletoSegunda" class="form-control" placeholder="Beleto Segunda ...">       
            </div>
            <div class="form-group">
                <label for="boletoEscolar">Boleto Escolar</label>
                <input class="form-control" name="boletoEscolar" id="boletoEscolar"   placeholder="Boleto Escolar ...">
            </div>
            <div class="form-group">
                <label for="boletoSecundario">Boleto Secundario</label>
                <input class="form-control" name="boletoSecundario" id="boletoSecundario"   placeholder="Boleto Secundario ...">
            </div>
            <div class="form-group">
                <label for="boletoJubilado">Boleto Jubilado</label>
                <input class="form-control" name="boletoJubilado" id="boletoJubilado"   placeholder="Boleto Jubilado ...">
            </div>
            <div class="form-group">
                <label for="boletoJubilado">Boleto Jubilado</label>
                <input class="form-control" name="boletoJubilado" id="boletoJubilado"   placeholder="Boleto Jubilado ...">
            </div>
            <div class="form-group">
                <label for="boleteoCombinado">Boleto Combinado</label>
                <input class="form-control" name="boleteoCombinado" id="boleteoCombinado"   placeholder="Boleto Combinado ...">
            </div>

            <div class="form-group">
                <button class = "btn btn-primary" type="submit"> Guardar</button>
                <button class = "btn btn-danger" type="reset"> Cancelar</button>                
                
                
            </div>
          
            {!!Form::close()!!}
            
        </div>
        @endif

    </div>

@endsection