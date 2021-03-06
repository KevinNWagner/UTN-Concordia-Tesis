@extends ('layouts.chofer')
@section ('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Listado de rendiciones <a href="rendicion/create"><button class="btn btn-success">Nuevo</button></a></h3>
            @include('chofer.rendicion.search')            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Fecha</th>
                    <th>Recaudacion</th>                    
                    <th>Opciones</th>
                </thead>
                @foreach($rendiciones as $tip)
                <tr>
                    
                    <td>{{DateTime::createFromFormat('Y-m-d H:i:s',$tip->fecha)->format('d-m-Y')}}</td>
                    <td>{{$tip->recaudacion}}</td>
                                        
         
                    <td>
                        
                    </td>
                </tr>
                 
                @endforeach
            </table>
            </div>
            {{$rendiciones->render()}}
        </div>
    </div>
@endsection
