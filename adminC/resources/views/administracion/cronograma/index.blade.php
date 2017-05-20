@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Listado de cronogramas <a href="cronograma/create"><button class="btn btn-success">Nuevo</button></a></h3>
            @include('administracion.cronograma.search')            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Fecha</th>
                    <th>Dia</th>  
                    <th>Cartelera</th>                                        
                    <th>Opciones</th>
                </thead>
                @foreach($cronogramas as $tip)
                <tr>
                    <td>{{ DateTime::createFromFormat('Y-m-d', $tip->fecha)->format('d-m-Y')}}</td>
                    <td></td>               
                    <td>{{$tip->cartelera}}</td>     
                    <td>
                        <a href="{{URL::action('CronogramaController@edit',$tip->idCronogramas)}}"><button class="btn btn-info">Editar</button></a>
                        
                         <a href="" data-target="#modal-delete-{{$tip->idCronogramas}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                        

                        
                       
                    </td>
                </tr>
                  @include('administracion.cronograma.modal')
                @endforeach
            </table>
            </div>
            {{$cronogramas->render()}}
        </div>
    </div>
@endsection
