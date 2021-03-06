<?php
namespace sisAdmin\Http\Controllers;

use Illuminate\Http\Request;

use sisAdmin\Http\Requests;
use sisAdmin\Http\Requests\RendicionChoferFormRequest;
use sisAdmin\Rendicion;
use DB;
use Illuminate\Support\Facades\Redirect;
use DateTime;
class RendicionAdministracionController extends Controller
{
    public function __contruct(){
       
    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));   
            
            $rendiciones = DB::table('rendiciones_boleteras')
            ->join('empleados','empleados.idEmpleados','=','rendiciones_boleteras.Empleados_idEmpleados')   
            ->orderBy('fecha','desc')
            ->where('fecha','like','%'.$query.'%')
            ->select('rendiciones_boleteras.*','empleados.Nombre as Nombre','empleados.Apellido as Apellido')
            ->paginate(7);
            

            return view('administracion.rendicion.index',["rendiciones"=>$rendiciones,"searchText"=>$query]);
        }
    }
    public function show($id){
        $rendicion=DB::table('rendiciones_boleteras')
        ->join('designaciones','designaciones.Empleados_idEmpleados','=','rendiciones_boleteras.Empleados_idEmpleados')       
        ->join('cronogramas','cronogramas.idCronogramas','=','designaciones.Cronogramas_idCronogramas')
        ->join('colectivos','colectivos.idColectivos','=','designaciones.Colectivos_idColectivos')               
        ->join('empleados','designaciones.Empleados_idEmpleados','=','empleados.idEmpleados')               
        ->where('rendiciones_boleteras.idRendicionesBoleteras','=',$id)
        ->select('empleados.nombre as nombre','colectivos.matricula as mat',
        'rendiciones_boleteras.fecha as fecha','empleados.apellido as apellido')
        ->first();
        $boletera=DB::table('rendiciones_boleteras')                    
        ->where('rendiciones_boleteras.idRendicionesBoleteras','=',$id)       
        ->first();
       // return vier('hello1');
        return view('administracion.rendicion.show',["rendicion"=>$rendicion,"boletera"=>$boletera]);
    }

}
