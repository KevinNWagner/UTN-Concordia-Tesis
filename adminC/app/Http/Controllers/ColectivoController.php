<?php

namespace sisAdmin\Http\Controllers;

use Illuminate\Http\Request;

use sisAdmin\Http\Requests;
use sisAdmin\Colectivo;
use Illuminate\Support\Facades\Redirect;
use sisAdmin\Http\Requests\ColectivoFormRequest;
use DB;


class ColectivoController extends Controller
{
 public function __contruct(){
        
    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $colectivos=DB::table('colectivos')
            ->orderBy('idColectivos','desc')
            ->paginate(7);
            return view('administracion.colectivo.index',["colectivos"=>$colectivos,"searchText"=>$query]);
        }
    }
    public function create(){
        return view('administracion.colectivo.create');

    }
    public function store(ColectivoFormRequest $request){
        $colectivo= new Colectivo;
        $colectivo->marca=$request->get('marca');       
        $colectivo->modelo=$request->get('modelo');       
        $colectivo->matricula=$request->get('matricula');       
        $colectivo->posicionLongitud=$request->get('posicionLongitud');       
        $colectivo->posicionLatitud=$request->get('posicionLatitud');       
        $colectivo->save();
        return Redirect::to('administracion/colectivo');        
    }
    public function show($id){
        return view('administracion.colectivo.show',["colectivo"=>Colectivo::findOrFail($id)]);
    }
    public function edit($id){
        return view('administracion.colectivo.edit',["colectivo"=>Colectivo::findOrFail($id)]);
    }
    public function update(ColectivoFormRequest $request , $id){
        $colectivo = Colectivo::findOrFail($id);
        $colectivo->marca=$request->get('marca');       
        $colectivo->modelo=$request->get('modelo');       
        $colectivo->matricula=$request->get('matricula');       
        $colectivo->posicionLongitud=$request->get('posicionLongitud');       
        $colectivo->posicionLatitud=$request->get('posicionLatitud');       
        $colectivo->update();
        return Redirect::to('administracion/colectivo');
    
    }
    public function destroy($id){
        $colectivo=Colectivo::findOrFail($id);
        
        $colectivo->delete();
        return Redirect::to('administracion/colectivo');
    }
}
