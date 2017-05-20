@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Listado de Colectivos <a href="colectivo/create"><button class="btn btn-success">Nuevo</button></a></h3>
            @include('administracion.colectivo.search')            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Matricula</th>
                    <th>Ubicacion</th>
                    <th>Opciones</th>
                </thead>
                @foreach($colectivos as $tip)
                <tr>
                    <td>{{$tip->idColectivos}}</td>
                    <td>{{$tip->marca}}</td>
                    <td>{{$tip->modelo}}</td>
                    <td>{{$tip->matricula}}</td>
                    <td></td>
         
                    <td>
                        <a href="{{URL::action('ColectivoController@edit',$tip->idColectivos)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$tip->idColectivos}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                        

                        
                       
                    </td>
                </tr>
                  @include('administracion.colectivo.modal')
                @endforeach
            </table>
            </div>
            {{$colectivos->render()}}
        </div>
    </div>
@endsection
