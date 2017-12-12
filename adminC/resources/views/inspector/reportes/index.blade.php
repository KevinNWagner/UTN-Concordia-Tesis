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
                    
                    <th>Desc.</th>
                    <th>Fecha</th>
                    <th>Colectivo</th>
                    <th>Chofer</th>
                   
                </thead>
                @foreach($reportes as $tip)
                <tr>
                    
                    <td>{{$tip->descripcion}}</td>
                    
                    <td> {{ DateTime::createFromFormat('Y-m-d', $tip->fecha)->format('d-m-Y')}}</td>
                    <td>{{$tip->matricula}}</td>
                    <td>{{$tip->nombre}}&nbsp{{$tip->apellido}} </td>
         
                   
                </tr>
               
                @endforeach
            </table>
            </div>
            {{$reportes->render()}}
        </div>
    </div>
@endsection
