@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Listado de empleados <a href="empleado/create"><button class="btn btn-success">Nuevo</button></a></h3>
            @include('administracion.empleado.search')            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    
                     <th>Nombre</th>
                    <th>Apellido</th>
                    
                    <th>Turno</th>
                    <th>Usuario</th>
                    
                    <th>Tipo</th>               
                    <th>Opciones</th>
                </thead>
                @foreach($empleados as $tip)
                <tr>
                                   
                    <td>{{$tip->nombre}}</td>
                    <td>{{$tip->apellido}}</td>
                    
                    <td>
                    @if($tip->turno===1)
                        Mañana
                    @else
                        Noche
                    @endif
                    </td>
                    <td>{{$tip->name}}</td>
                    
                    <td>{{$tip->tipo}}</td>
                    
         
                    <td>
                        <a href="{{URL::action('EmpleadoController@show',$tip->idEmpleados)}}"><button class="btn btn-default">Ver</button></a>
                        <a href="{{URL::action('EmpleadoController@edit',$tip->idEmpleados)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$tip->idEmpleados}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                        

                        
                       
                    </td>
                </tr>
                  @include('administracion.empleado.modal')
                @endforeach
            </table>
            </div>
            {{$empleados->render()}}
        </div>
    </div>
@endsection
