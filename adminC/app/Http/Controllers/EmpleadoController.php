<?php

namespace sisAdmin\Http\Controllers;

use Illuminate\Http\Request;

use sisAdmin\Http\Requests;
use sisAdmin\Empleado;
use sisAdmin\User;
use Illuminate\Support\Facades\Redirect;
use sisAdmin\Http\Requests\EmpleadoFormRequest;
use sisAdmin\Http\Requests\UFormRequest;
use sisAdmin\Http\Requests\UpdateUserEmpleadoFormRequest;
use DB;
use DateTime;

class EmpleadoController extends Controller
{
    public function __contruct(){
       
    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));   

            $empleados = DB::table('empleados')
            ->join('users', 'users.name', '=', 'empleados.name')            
            ->join('tipos', 'tipos.idTipos', '=', 'users.Tipos_idTipos')            
            ->select('empleados.*', 'tipos.nombre as tipo')
            

           // $empleados=DB::table('empleados')->join('tipos','tipos.idTipos','=','empleados.Tipos_idTipos')->where('empleados.nombre','LIKE','%'.$query.'%')
            //DB::table('empleados')->where('nombre','LIKE','%'.$query.'%')
            
            
            
            ->orderBy('empleados.idEmpleados','desc')
            ->paginate(7);
            
            return view('administracion.empleado.index',["empleados"=>$empleados,"searchText"=>$query]);
        }
    }
    public function create(){
        $tipos=DB::table('tipos')->get();

        
            
        return view('administracion.empleado.create',["tipos"=>$tipos]);

    }
    public function store(EmpleadoFormRequest $request,UFormRequest $userRequest){
        
              
        

        $empleado= new Empleado;
        $empleado->nombre=$request->get('nombre');         
        $empleado->apellido= $request->get('apellido');
        $empleado->domicilio=$request->get('domicilio');
        $empleado->telefono=$request->get('telefono');
        $empleado->celular=$request->get('celular');
        $empleado->fechaNacimiento=DateTime::createFromFormat('d-m-Y', $request->get('fechaNacimiento'))->format("Y-m-d");
        $empleado->fechaAntiguedad=DateTime::createFromFormat('d-m-Y', $request->get('fechaAntiguedad'))->format("Y-m-d");
        $empleado->turno=$request->get('idturno');       
        
        $empleado->name=$request->get('name');     
       
        
        \sisAdmin\User::create([
            'name'=>$userRequest->get('name'),
            'email'=>$userRequest->get('email'),            
            'password'=>bcrypt($userRequest->get('password')),
            'Tipos_idTipos'=>$userRequest->get('idtipo'),
        ]);     
        
        $empleado->save(); 
       
        return Redirect::to('administracion/empleado');

    }
    public function show($id){
        $tipos=DB::table('tipos')->get();
        return view('administracion.empleado.show',["tipos"=>$tipos,"empleado"=>Empleado::findOrFail($id)]);
    }
    public function edit($id){
        $tipos = DB::table('tipos')->get();
        $empleados = DB::table('empleados')
            ->join('users', 'users.name', '=', 'empleados.name')            
            ->join('tipos', 'tipos.idTipos', '=', 'users.Tipos_idTipos')            
            ->select('empleados.*', 'tipos.nombre as tipo','tipos.idTipos as idtipo','users.id as iduser')
            ->where('empleados.idEmpleados',$id)->first();
            

        return view('administracion.empleado.edit',["empleado"=>Empleado::findOrFail($id),"user"=>User::findOrFail($empleados->iduser),"tipos"=>$tipos,]);
    }
    public function update(UpdateUserEmpleadoFormRequest $request,$id,$iduser){
        
        $empleado = Empleado::findOrFail($id);
        $empleado->nombre=$request->get('nombre');         
        $empleado->apellido= $request->get('apellido');
        $empleado->domicilio=$request->get('domicilio');
        $empleado->telefono=$request->get('telefono');
        $empleado->celular=$request->get('celular');
        $empleado->fechaNacimiento=DateTime::createFromFormat('d-m-Y', $request->get('fechaNacimiento'))->format("Y-m-d");
        $empleado->fechaAntiguedad=DateTime::createFromFormat('d-m-Y', $request->get('fechaAntiguedad'))->format("Y-m-d");
        $empleado->turno=$request->get('idturno');       

        if($request->get('password')){
        $user=User::findOrFail($iduser);                        
        
        $user->password=bcrypt($request->get('password'));
        $user->update();                    
        }
       
        $empleado->update();
        
        return Redirect::to('administracion/empleado');
        

    }
    public function destroy($id){
        $empleado=Empleado::findOrFail($id);
        
        $empleado->delete();
        return Redirect::to('administracion/empleado');
    }
}
