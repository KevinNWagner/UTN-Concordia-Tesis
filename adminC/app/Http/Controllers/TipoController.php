<?php

namespace sisAdmin\Http\Controllers;

use Illuminate\Http\Request;

use sisAdmin\Http\Requests;
use sisAdmin\Tipo;
use Illuminate\Support\Facades\Redirect;
use sisAdmin\Http\Requests\TipoFormRequest;
use DB;

class TipoController extends Controller
{
    public function __contruct(){
        
    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $tipos=DB::table('tipos')->where('Nombre','LIKE','%'.$query.'%')
            ->orderBy('idTipos','desc')
            ->paginate(7);
            return view('administracion.tipo.index',["tipos"=>$tipos,"searchText"=>$query]);
        }
    }
    public function create(){
        return view('administracion.tipo.create');

    }
    public function store(TipoFormRequest $request){
        $tipo= new Tipo;
        $tipo->nombre=$request->get('nombre');       
        $tipo->save();
        return Redirect::to('administracion/tipo');

    }
    public function show($id){
        return view('administracion.tipo.show',["tipo"=>Tipo::findOrFail($id)]);
    }
    public function edit($id){
        return view('administracion.tipo.edit',["tipo"=>Tipo::findOrFail($id)]);
    }
    public function update(TipoFormRequest $request , $id){
        $tipo = Tipo::findOrFail($id);
        $tipo->nombre = $request->get('nombre');
        
        $tipo->update();
        return Redirect::to('administracion/tipo');
        

    }
    public function destroy($id){
        $tipo=Tipo::findOrFail($id);
        
        $tipo->delete();
        return Redirect::to('administracion/tipo');
    }
}