@extends ('layouts.inspector')


@section ('contenido')
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Bienvenido inspector {{Auth::user()->name}}</h3>
                 
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
			
                
            </div>
           
        </div>
    </div>
@endsection
