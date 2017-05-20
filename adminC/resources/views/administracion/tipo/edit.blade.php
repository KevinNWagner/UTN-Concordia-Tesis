@extends ('layouts.admin')
<?php
use Illuminate\Support\Facades\Redirect;
?>

@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
            <h3>Editar Tipo:{{ $tipo->Nombre}} </h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{$err}}</li>
                    @endforeach
                </ul>

            </div>
            @endif
            
            {!!Form::model($tipo,['method'=>'PATCH','route'=>['administracion.tipo.update',$tipo->idTipos]])!!}
            
            {{Form::token()}}
            <div class="form-group">
                <label for="nombre"> Nombre </label>
                <input type="text" name="nombre" value="{{ $tipo->Nombre}}"
                 class="form-control" placeholder="Nombre ...">       
            </div>
            
            <div class="form-group">
                <button class = "btn btn-primary" type="submit"> Guardar</button>
                <button class = "btn btn-danger" type="reset"> Cancelar</button>                
                
                
            </div>
            {!!Form::close()!!}
            
        </div>
    </div>

@endsection