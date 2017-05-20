@extends ('layouts.admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
            <h3 id="titulo">Crear Designaciones</h3>
            <div id="errors"></div>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    <li value='a'></li>
                    @foreach($errors->all() as $err)
                        <li>{{$err}}</li>
                    @endforeach
                </ul>

            </div>
            @endif
            {!!Form::model('designacion',['method'=>'POST','onsubmit'=>'return(validate());','action' => array('CronogramaController@storeDesignacion', $cartelera->idCarteleras, $cronograma->fecha)])!!}
          
            {{Form::token()}}
             <div class="form-group">
                <label for="descripcion">Fecha</label>
                <input class="form-control" name="fecha" id="fecha"  value="{{$cronograma->fecha}}" >   
            </div>
            <div class="form-group">
                <label for="cartelera">Cartelera</label>               
                <input class="form-control" name="cartelera" id="cartelera"  value="{{$cartelera->descripcion}}" disabled>                              
            </div>
            <div class="form-group">
                <label for="cartelera">Cant. Personas</label>               
                <input class="form-control" name="cantidadPersonas" id="cantidadPersonas"  value="{{$cartelera->cantidadPersonas}}" disabled>     
            </div>
            @php($NoContinuar = false)
            @for($count=1;$count<=round($cartelera->cantidadPersonas/800);$count++)
              
            <div class="form-group">                
            <label for="colectivo">Colectivo {{$count}}</label>
                <select name="colectivo[]" id="colectivo[]" class="form-control">
                @if(count($colectivo)<$count)
                 <option disabled selected value> No hay suficientes colectivos </option>
                 @php($NoContinuar = true)
                @else
                    @php($c=0)    
                    @foreach($colectivo as $cole)
                    @php($c++)    
                        @if($c===$count)
                        <option value="{{$cole->idColectivos}}" selected="selected">{{$cole->matricula}}</option>
                        @else
                            <option value="{{$cole->idColectivos}}" >{{$cole->matricula}}</option>
                        @endif                      
                    @endforeach
                @endif
                </select>
            </div>
            
            <div class="form-group">
                <label for="chofer1">Chofer 1er Turno</label>               
                <select name="chofer1[]" id="chofer1[]" class="form-control" >
                @if(count($choferesT1)<$count)
                 <option disabled selected value> No hay suficientes choferes del 1er turno </option>
                 @php($NoContinuar = true)
                @else
                    @php($c1=0)   
                    @foreach($choferesT1 as $chof1)
                        @php($c1++)
                        @if($c1===$count)
                        <option value="{{$chof1->idEmpleados}}" selected="selected" >{{$chof1->nombre}} {{$chof1->apellido}}</option>
                        @else
                            <option value="{{$chof1->idEmpleados}}"  >{{$chof1->nombre}} {{$chof1->apellido}}</option>
                        @endif
                    @endforeach
                @endif
                 
                </select>
            </div>
            <div class="form-group">
                <label for="cartelera">Chofer 2er Turno</label>               
                <select name="chofer2[]" id="chofer2[]" class="form-control"> 
                @if(count($choferesT2)<$count)
                 <option disabled selected value> No hay suficientes choferes del 2do turno </option>
                 @php($NoContinuar = true)  
                @else
                    @php($c2=0) 
                    @foreach($choferesT2 as $chof2)
                    @php($c2++)
                        @if($c2===$count)
                        <option value="{{$chof2->idEmpleados}}" selected="selected" >{{$chof2->nombre}} {{$chof2->apellido}}</option>
                        @else
                        <option value="{{$chof2->idEmpleados}}" >{{$chof2->nombre}} {{$chof2->apellido}}</option>
                        @endif
                    @endforeach
                @endif
                 
                </select>
            </div>
         

            @endfor
         

            <div class="form-group">
             
               
                @if(!$NoContinuar)
                <button class = "btn btn-primary" type="submit"> Guardar</button>
                {!!Form::close()!!}
                 <a href="cronograma"><button class="btn btn-danger">Cancelar</button></a>
                @else                
                 {!!Form::close()!!}
                 <a href="cronograma"><button class="btn btn-danger">Cancelar</button></a>
                <font color="red">No hay suficientes recursos para este cronograma</font>               
                @endif
                               
                
                
            </div>
             
           
             
            
        </div>
    </div>
<script>

//This will execute when the user presses the submit button.
/*
function validate() {
  //Loop through all form elements.
  var open= '<div class="alert alert-danger"><ul><li>Valores duplicados en';
  var close='</li></ul></div>';
  
        var chofer1 = document.forms[0].elements["chofer1[]"];
        var chofer2 = document.forms[0].elements["chofer2[]"]; 
        var colectivo = document.forms[0].elements["colectivo[]"];  
        var ch1=new Array(),ch2=new Array(),col = new Array();
        for (var i = 0, len = chofer1.length; i < len; i++) {
        ch1[i]=chofer1[i].value;
        ch2[i]=chofer2[i].value;
        col[i]=colectivo[i].value;
        }             
        
         $('#errors').empty();
        if((new Set(ch1)).size !== ch1.length){     
            $('#errors').append(open+' chofer 1er turno'+close);            
            return false; 
        }
        if((new Set(ch2)).size !== ch2.length){
              $('#errors').append(open+' chofer 2do turno'+close);            
              return false; 
        }
        if((new Set(col)).size !== col.length){
              $('#errors').append(open+' colectivos'+close);
              return false; 
            
        }
       
      return true; 
      
  }


</script>
@endsection

