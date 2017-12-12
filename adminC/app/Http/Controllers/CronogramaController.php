<?php

namespace sisAdmin\Http\Controllers;

use Illuminate\Http\Request;

use sisAdmin\Http\Requests;
use sisAdmin\Cronograma;
use sisAdmin\Designacion;
use Illuminate\Support\Facades\Redirect;
use sisAdmin\Http\Requests\CronogramaFormRequest;
use sisAdmin\Http\Requests\DesignacionFormRequest;
use DB;
use DateTime;

class CronogramaController extends Controller
{
     public function __contruct(){
        
    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $cronogramas=DB::table('cronogramas')
            ->join('carteleras','carteleras.idCarteleras','=','cronogramas.Carteleras_idCarteleras')
            ->select('cronogramas.*','carteleras.descripcion as cartelera')
            ->orderBy('fecha','desc')
            ->where('carteleras.descripcion','LIKE','%'.$query.'%')    
            ->paginate(7);
            
            return view('administracion.cronograma.index',["cronogramas"=>$cronogramas,"searchText"=>$query]);
        }
    }
    public function create(){
        $carteleras=DB::table('carteleras')->get();

        
            
        return view('administracion.cronograma.create',["carteleras"=>$carteleras]);


    }
   
    public function store(CronogramaFormRequest $request){
        $cronograma= new Cronograma;
        $cronograma->Carteleras_idCarteleras=$request->get('Carteleras_idCarteleras');       
        $cronograma->fecha=$request->get('fecha');               
        

       
        $cartelera=DB::table('carteleras')
        ->where('idCarteleras','=',$cronograma->Carteleras_idCarteleras)
        ->first();

     

        $colectivo=DB::table('colectivos')  ->get();
     
        
        $choferesT1=DB::table('empleados')
        ->join('users','users.name','=','empleados.name')       
        ->select('empleados.*')
         ->where('users.Tipos_idTipos','=','2')
        ->where('empleados.turno','=','1')->get()  ;

       
        $choferesT2=DB::table('empleados')
        ->join('users','users.name','=','empleados.name')
        ->select('empleados.*')
        ->where('users.Tipos_idTipos','=','2')
        ->where('empleados.turno','=','2')->get()  ;

      
        return view('administracion.designacion.create',["cronograma"=>$cronograma,"choferesT2"=>$choferesT2,"choferesT1"=>$choferesT1,"colectivo"=>$colectivo,"cartelera"=>$cartelera,]);
    }
    public function storeDesignacion(DesignacionFormRequest $request,$idCartelera,$fecha){
        //guardamos el cronograma

        $chofer1=$request->get('chofer1');
        $chofer2=$request->get('chofer2');
        $colectivo=$request->get('colectivo');
        

        $carteleras=DB::table('carteleras')->get();        
        $error= "Hubo un elemnto duplicado y no se pudo continuar .. ";
        $ret= view('administracion.cronograma.create',["carteleras"=>$carteleras])->withErrors($error);
        if ( count($chofer1) != count(array_unique($chofer1))){                       
        return $ret;
        }
        if ( count($chofer2) != count(array_unique($chofer2))){        
        return $ret;
        }
        if ( count($colectivo) != count(array_unique($colectivo))){        
        return $ret;
        }
         

        $cronograma= new Cronograma;
        $cronograma->Carteleras_idCarteleras=$idCartelera;
        $cronograma->fecha=$fecha;
        $cronograma->save();

        $cronogramas=DB::table('cronogramas')
        ->where('fecha','=',$fecha)
        ->first();
        
        $crono = [];
        for($i= 0; $i < count($colectivo); $i++){
            $crono[] = [
                'Cronogramas_idCronogramas' => $cronogramas->idCronogramas,
                'Colectivos_idColectivos' => $colectivo[$i],
                'Empleados_idEmpleados' => $chofer1[$i],
                'orden'=>$i+1,
                
            ];
        }
        for($i= 0; $i < count($colectivo); $i++){
            $crono[] = [
                'Cronogramas_idCronogramas' => $cronogramas->idCronogramas,
                'Colectivos_idColectivos' => $colectivo[$i],
                'Empleados_idEmpleados' => $chofer2[$i],
                'orden'=>$i+1,
                
            ];
        }
       
       \DB::table('designaciones')->insert($crono);
        
   
       
    return Redirect::to('administracion/cronograma');
    }
    public function duplicados($array){
        if(count($array) == count(array_unique($array))){
            return true;
        }else{
            return false;
        }
    }
    public function show($id){
        return view('administracion.cronograma.show',["cronograma"=>Cartelera::findOrFail($id)]);
    }
    public function edit($id){
        return view('administracion.cartelera.edit',["cartelera"=>Cartelera::findOrFail($id)]);
    }
    public function update(CarteleraFormRequest $request , $id){
        $cartelera = Cartelera::findOrFail($id);
        $cartelera->horaInicio=$request->get('horaInicio');       
        $cartelera->horaFin=$request->get('horaFin');       
        $cartelera->cantidadPersonas=$request->get('cantidadPersonas');       
        $cartelera->duracionRecorrido=$request->get('duracionRecorrido');       
        $cartelera->descripcion=$request->get('descripcion');       
        $cartelera->update();
        return Redirect::to('administracion/cartelera');
    
    }
    public function destroy($id){
        $asignaciones=DB::table('designaciones')
        ->where('Cronogramas_idCronogramas','=',$id)
        ->delete();
        $cronograma=Cronograma::findOrFail($id);        
        $cronograma->delete();
        return Redirect::to('administracion/cronograma');
    }
}
