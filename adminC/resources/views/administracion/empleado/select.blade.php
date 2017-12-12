@extends ('layouts.admin')
@section ('contenido')
{{--*/ $tipoS = $tipoB; /*--}}
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Listado de empleados <a href="empleado/create"><button class="btn btn-success">Nuevo</button></a></h3>
            {!! Form::open(array('url'=>'administracion/empleado/'.$tipoS,'method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
            <div class = "form-grpup">
                <div class="input-group">
                    <input type="text"  class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </span>
            {{Form::close()}}       
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
                {{--*/ $tipoS = 'test' /*--}}
                @foreach($empleados as $tip)
                {{--*/ $tipoS = $tip->tipo /*--}}
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
