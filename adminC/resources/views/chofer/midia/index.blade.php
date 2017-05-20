@extends ('layouts.chofer')
@section ('contenido')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         @if($designacion)
            <h3>Mi horario</h3>
         @else
            <h3>El dia de hoy no fue asignado a el cronograma.</h3>
        @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @if($designacion)
            <div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Partida</th>
                    <th>Llegada</th>            
                    <th>Mat.Colectivo</th>
                     <th>ID Colectivo</th>
                </thead>
                
                @foreach($miHorario as $hh)
                <tr>
                    
                    <td>{{$hh['inicio']}}</td>
                    <td>{{$hh['fin']}}</td>
                    <td>{{$hh['colectivo']}}</td>  
                     <td>{{$designacion->Colectivos_idColectivos}}</td>                                 
                </tr>                
                @endforeach
            </table>          
            </div>
        @endif
        
            
        </div>
    </div>
@endsection
