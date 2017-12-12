<?php

namespace sisAdmin\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use sisAdmin\Http\Requests;
use sisAdmin\Reporte;
use DateTime;
use sisAdmin\Http\Requests\ReporteFormRequest;
use Illuminate\Support\Facades\Redirect;

class ReporteController extends Controller
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

            $reportes = DB::table('reportes_inspectores')  
            ->join('colectivos','colectivos.idColectivos','=','reportes_inspectores.Colectivos_idColectivos') 
            ->join('empleados','empleados.idEmpleados','=','reportes_inspectores.Empleados_idEmpleadosChofer') 
            ->orderBy('fecha','desc')
            ->where('fecha','like','%'.$query.'%')
            ->where('Empleados_idEmpleadosInspector','=',$usuario->idEmpleado)
            ->select('reportes_inspectores.*','colectivos.matricula as matricula',
            'empleados.nombre as nombre','empleados.apellido as apellido')
            ->paginate(7);
            

            return view('inspector.reportes.index',["reportes"=>$reportes,"searchText"=>$query]);
        }
    }
    
    public function create(){
        $colectivos = DB::table('colectivos')
        ->get();
        $choferes = DB::table('empleados')
        ->where('turno','=',2)->get();
        return view('inspector.reportes.create',["colectivo"=>$colectivos,"chofer"=>$choferes]);

    }
    
    public function store(ReporteFormRequest $request){

        $usuario = DB::table('users')       
            ->join('empleados','empleados.name','=','users.name') 
            ->select('users.*','empleados.idEmpleados as idEmpleado','empleados.turno as turno')
            ->where('users.name','=',\Auth::user()->name)
            ->first();


        $reporte= new Reporte;
        $reporte->descripcion=$request->get('desc');       
        $reporte->fecha=DateTime::createFromFormat('d-m-Y', $request->get('fecha'))->format("Y-m-d");
        //$reporte->fecha=$reporte->get('fecha');       
        $reporte->Colectivos_idColectivos=$request->get('colectivo');   
        $reporte->Empleados_idEmpleadosChofer=$request->get('chofer');   
        $reporte->Empleados_idEmpleadosInspector=$usuario->idEmpleado;   
        $reporte->save();
         
        return Redirect::to('inspector/reportes');

    }
}
