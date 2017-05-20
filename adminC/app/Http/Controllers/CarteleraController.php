<?php

namespace sisAdmin\Http\Controllers;

use Illuminate\Http\Request;

use sisAdmin\Http\Requests;
use sisAdmin\Cartelera;
use Illuminate\Support\Facades\Redirect;
use sisAdmin\Http\Requests\CarteleraFormRequest;
use DB;
use DateTime;
class CarteleraController extends Controller
{
     public function __contruct(){
        
    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $carteleras=DB::table('carteleras')
            ->orderBy('idCarteleras','desc')
            ->paginate(7);
            return view('administracion.cartelera.index',["carteleras"=>$carteleras,"searchText"=>$query]);
        }
    }
    public function create(){
        return view('administracion.cartelera.create');

    }
    public function store(CarteleraFormRequest $request){
        $cartelera= new Cartelera;
        $cartelera->horaInicio=$request->get('horaInicio');       
        $cartelera->horaFin=$request->get('horaFin');       
        $cartelera->cantidadPersonas=$request->get('cantidadPersonas');       
        $cartelera->duracionRecorrido=$request->get('duracionRecorrido');       
        $cartelera->descripcion=$request->get('descripcion');       
        $cartelera->save();
        return Redirect::to('administracion/cartelera');        
    }
    public function show($id){
        return view('administracion.cartelera.show',["cartelera"=>Cartelera::findOrFail($id)]);
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
        $cartelera=Cartelera::findOrFail($id);
        
        $cartelera->delete();
        return Redirect::to('administracion/cartelera');
    }
}
