@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Listado de rendiciones </h3>
            @include('administracion.rendicion.search')   
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Fecha</th>
                    <th>Recaudacion</th>      
                    <th>Empleado</th>                    
                    <th>Opciones</th>
                </thead>
                @foreach($rendiciones as $tip)
                <tr>
                    
                    <td>{{DateTime::createFromFormat('Y-m-d H:i:s',$tip->fecha)->format('d-m-Y')}}</td>
                    <td>{{$tip->recaudacion}}</td>
                    <td>{{$tip->Nombre}} {{$tip->Apellido}}</td>                  
                    
                    <td>
                    <a href="{{URL::action('RendicionAdministracionController@show',$tip->idRendicionesBoleteras)}}"><button class="btn btn-default">Ver</button></a>
                    </td>
                </tr>
                 
                @endforeach
            </table>
            </div>
            {{$rendiciones->render()}}
        </div>
    </div>
@endsection
