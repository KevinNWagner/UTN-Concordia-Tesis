@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @if($designacion)
            <h3>El horario de hoy</h3>
         @else
            <h3>El dia de hoy, no fue asignado ningún cronograma.</h3>
        @endif
        @if($designacion)
            <div class="table-responsive">
			<table id = "myTable" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Posicion</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Colectivo</th>
                    <th>Empleado</th>
                    
                </thead>
                @php($a=1)
                @foreach($miHorario as $hh)
                <tr>
                    <td>{{$a++}}</td>
                    <td>{{$hh['inicio']}}</td>
                       <td>{{$hh['fin']}}</td>
                       <td>{{$hh['colectivo']}}</td>
                       <td>{{$hh['empleado']}}</td>
                 
                  
                </tr>
                 
                @endforeach
            </table>
            </div>
       
        </div>
        @endif
    </div>
    <script>
    
    $(document).ready(function(){
        $('#myTable').DataTable( {
      "oLanguage": {
         "sSearch": "Buscar:",
         "sInfo": "Mostrando del _START_ al _END_ de _TOTAL_ registros",
         "oPaginate": {
           "sPrevious": "Anterior",
            "sNext": "Siguiente",
         },
           
       },
       
        dom: 'Bfrtip',
        buttons: [
            {
            text: '<i class="fa fa-lg fa-print"></i> Imprimir',
            extend: 'print',
            className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn export-print',}
            
        ]
        
     
        
        } );
    });
    </script>

@endsection
