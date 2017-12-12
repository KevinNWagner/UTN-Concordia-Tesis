<?php

namespace sisAdmin\Http\Controllers;

use Illuminate\Http\Request;
use sisAdmin\Http\Requests;
use sisAdmin\Http\Requests\ReporteFormRequest;
use Illuminate\Support\Facades\Redirect;
use DB;

use sisAdmin\Reporte;
use DateTime;


class AdminReporteController extends Controller
{
    public function __contruct(){
        
     }
 
     public function index(Request $request){
         if($request){
            $query=trim($request->get('searchText'));
            $cat=trim($request->get('categoria'));
            if($cat === "" )
                $cat = "fecha";
            
             $reportes = DB::table('reportes_inspectores')  
             ->join('colectivos','colectivos.idColectivos','=','reportes_inspectores.Colectivos_idColectivos') 
             ->join('empleados as E2','E2.idEmpleados','=','reportes_inspectores.Empleados_idEmpleadosInspector') 
             ->join('empleados as E1','E1.idEmpleados','=','reportes_inspectores.Empleados_idEmpleadosChofer') 
             ->orderBy('fecha','desc')      
             
                ->where($cat,'LIKE','%'.$query.'%')                     
           
             
             ->select('reportes_inspectores.*','colectivos.matricula as matricula',
             'E1.nombre as NombreC','E1.apellido as ApellidoC', 
             'E2.nombre as NombreI','E2.apellido as ApellidoI')
             ->paginate(7);
             $crono = [];
             $crono[] = ['name' => 'fecha','desc' => 'Fecha'];
            $crono[] = ['name' => 'E2.name','desc' => 'Inspector'];
            $crono[] = ['name' => 'E1.name','desc' => 'Chofer'];
            $crono[] = ['name' => 'colectivos.matricula','desc' => 'Matricula'];
             
 
             return view('administracion.reporte.index',["reportes"=>$reportes,"crono"=>$crono,"searchText"=>$query,"value"=>$cat]);
         }
     }
     public function show($idReporte){
        
           
           

            $reportes = DB::table('reportes_inspectores')  
            ->join('colectivos','colectivos.idColectivos','=','reportes_inspectores.Colectivos_idColectivos') 
            ->join('empleados as E2','E2.idEmpleados','=','reportes_inspectores.Empleados_idEmpleadosInspector') 
            ->join('empleados as E1','E1.idEmpleados','=','reportes_inspectores.Empleados_idEmpleadosChofer') 
            ->orderBy('fecha','desc')                        
            ->select('reportes_inspectores.*','colectivos.matricula as matricula',
            'E1.nombre as NombreC','E1.apellido as ApellidoC', 
            'E2.nombre as NombreI','E2.apellido as ApellidoI')
            ->where('reportes_inspectores.idReportesInspectores','=',$idReporte)
            ->first();
            

            return view('administracion.reporte.show',["reportes"=>$reportes]);
        
    }
    public function search(Request $request){
        if($request){
           $query=trim($request->get('searchText'));
           

            $reportes = DB::table('reportes_inspectores')  
            ->join('colectivos','colectivos.idColectivos','=','reportes_inspectores.Colectivos_idColectivos') 
            ->join('empleados as E2','E2.idEmpleados','=','reportes_inspectores.Empleados_idEmpleadosInspector') 
            ->join('empleados as E1','E1.idEmpleados','=','reportes_inspectores.Empleados_idEmpleadosChofer') 
            ->orderBy('fecha','desc')      
            ->where('E2.name','LIKE','%'.$query.'%')                  
            ->select('reportes_inspectores.*','colectivos.matricula as matricula',
            'E1.nombre as NombreC','E1.apellido as ApellidoC', 
            'E2.nombre as NombreI','E2.apellido as ApellidoI')
            ->paginate(7);
            

            return view('administracion.reporte.index',["reportes"=>$reportes,"searchText"=>$query]);
        }
    }
}
