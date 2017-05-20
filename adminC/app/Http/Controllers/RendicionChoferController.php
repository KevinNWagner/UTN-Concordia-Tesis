<?php

namespace sisAdmin\Http\Controllers;

use Illuminate\Http\Request;

use sisAdmin\Http\Requests;
use sisAdmin\Http\Requests\RendicionChoferFormRequest;
use sisAdmin\Rendicion;
use DB;
use Illuminate\Support\Facades\Redirect;
use DateTime;
class RendicionChoferController extends Controller
{
     public function __contruct(){
       
    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));   
            $usuario = DB::table('users')       
            ->join('empleados','empleados.name','=','users.name') 
            ->select('users.*','empleados.idEmpleados as idEmpleado','empleados.turno as turno')
            ->where('users.name','=',\Auth::user()->name)
            ->first();

            $rendiciones = DB::table('rendiciones_boleteras')  
            ->orderBy('fecha','desc')
            ->where('fecha','like','%'.$query.'%')
            ->where('Empleados_idEmpleados','=',$usuario->idEmpleado)
            ->paginate(7);
            

            return view('chofer.rendicion.index',["rendiciones"=>$rendiciones,"searchText"=>$query]);
        }
    }
    public function create(){
         $usuario = DB::table('users')       
        ->join('empleados','empleados.name','=','users.name') 
        ->select('users.*','empleados.idEmpleados as idEmpleado','empleados.turno as turno')
        ->where('users.name','=',\Auth::user()->name)
        ->first();

        $designacion=DB::table('designaciones')
        ->join('cronogramas','Cronogramas.idCronogramas','=','Cronogramas_idCronogramas')
        ->join('colectivos','colectivos.idColectivos','=','designaciones.Colectivos_idColectivos')       
        ->where('designaciones.Empleados_idEmpleados','=',$usuario->idEmpleado)
        ->where('cronogramas.fecha','=',date('Y-m-d'))       
        ->select('designaciones.*','colectivos.matricula as matricula','cronogramas.fecha as fecha')->first();


        return view('chofer.rendicion.create',["designacion"=>$designacion]);

    }
    public function store(RendicionChoferFormRequest $request){
        $rendicion= new Rendicion;
        $rendicion->fecha=$request->get('fecha');         
        $rendicion->Empleados_idEmpleados= $request->get('Empleados_idEmpleados');
        $rendicion->Colectivos_idColectivos=$request->get('Colectivos_idColectivos');
        $rendicion->recaudacion=$request->get('recaudacion');
        $rendicion->boletoPrimera=$request->get('boletoPrimera');
        $rendicion->beletoSegunda=$request->get('beletoSegunda');
        $rendicion->boletoEscolar=$request->get('boletoEscolar');     
        $rendicion->boletoSecundario=$request->get('boletoSecundario');
        $rendicion->boletoJubilado=$request->get('boletoJubilado');
        $rendicion->boleteoCombinado=$request->get('boleteoCombinado');
        $rendicion->save(); 
       
        return Redirect::to('chofer/midia');

    }
    public function show($id){
        $tipos=DB::table('tipos')->get();
        return view('administracion.empleado.show',["tipos"=>$tipos,"empleado"=>Empleado::findOrFail($id)]);
    }
}
