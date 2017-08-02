@extends ('layouts.inspector')
@section ('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Listado de reportes <a href="reportes/create"><button class="btn btn-success">Nuevo</button></a></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>ID</th>
                    <th>Desc.</th>
                    <th>Fecha</th>
                    <th>Colectivo</th>
                    <th>Chofer</th>
                    <th>Opciones</th>
                </thead>
                @foreach($reportes as $tip)
                <tr>
                    <td>{{$tip->idReportesInspectores}}</td>
                    <td>{{$tip->descripcion}}</td>
                    <td>{{$tip->fecha}}</td>
                    <td>{{$tip->Colectivos_idColectivos}}</td>
                    <td>{{$tip->Empleados_idEmpleadosChofer}}</td>
         
                    <td>
                        
                        
                       
                    </td>
                </tr>
               
                @endforeach
            </table>
            </div>
            {{$reportes->render()}}
        </div>
    </div>
@endsection
