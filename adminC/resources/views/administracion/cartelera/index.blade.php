@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Listado de Carteleras <a href="cartelera/create"><button class="btn btn-success">Nuevo</button></a></h3>
            @include('administracion.cartelera.search')            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Descp.</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                    <th>Cant. Personas</th>
                    <th>Duracion Recr.</th>
                    <th>Opciones</th>
                </thead>
                @foreach($carteleras as $tip)
                <tr>
                    <td>{{$tip->descripcion}}</td>
                    <td>{{DateTime::createFromFormat('H:i:s',$tip->horaInicio)->format('H:i')}}</td>
                    <td>{{DateTime::createFromFormat('H:i:s',$tip->horaFin)->format('H:i')}}</td>
                    <td>{{$tip->cantidadPersonas}}</td>
                    <td>{{DateTime::createFromFormat('H:i:s',$tip->duracionRecorrido)->format('H:i')}}</td>
         
                    <td>
                        <a href="{{URL::action('CarteleraController@edit',$tip->idCarteleras)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$tip->idCarteleras}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                        

                        
                       
                    </td>
                </tr>
                  @include('administracion.cartelera.modal')
                @endforeach
            </table>
            </div>
            {{$carteleras->render()}}
        </div>
    </div>
@endsection
