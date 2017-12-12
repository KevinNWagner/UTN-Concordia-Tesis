@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Listado de reportes </h3>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">           
            @include('administracion.reporte.search')            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Fecha</th>
                    <th>Inspector</th>      
                    <th>Chofer</th>                    
                    <th>Colectivo</th>
                    <th>Descripcion</th>
                </thead>
                @foreach($reportes as $tip)
                <tr>
                    
                    <td>{{DateTime::createFromFormat('Y-m-d',$tip->fecha)->format('d-m-Y')}}</td>
                    <td>{{$tip->NombreI}} {{$tip->ApellidoI}}</td>
                    <td>{{$tip->NombreC}} {{$tip->ApellidoC}}</td>                  
                    <td>{{$tip->matricula}}</td>                  
                    <td align=center ><a href="{{URL::action('AdminReporteController@show',$tip->idReportesInspectores)}}">
                    <button  class="btn btn-info">Ver</button></a>  </td>
                    
                </tr>
                 
                @endforeach
            </table>
            </div>
            {{$reportes->render()}}
            
        </div>
    </div>
@endsection
