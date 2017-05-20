<?php

namespace sisAdmin\Http\Controllers;

use Illuminate\Http\Request;

use sisAdmin\Http\Requests;

class DesignacionController extends Controller
{
    public function __contruct(){
        
    }

    public function index(Request $request){
       /*
        if($request){
            $query=trim($request->get('searchText'));
            $cronogramas=DB::table('cronogramas')
            ->join('carteleras','carteleras.idCarteleras','=','cronogramas.Carteleras_idCarteleras')
            ->select('cronogramas.*','carteleras.descripcion as cartelera')
            ->orderBy('fecha','desc')
            ->paginate(7);
            return view('administracion.cronograma.index',["cronogramas"=>$cronogramas,"searchText"=>$query]);
        }
        */
    }
    public function create(){
        $carteleras=DB::table('carteleras')->get();
        $cronogramas=DB::table('cronogramas')
            ->join('carteleras','carteleras.idCarteleras','=','cronogramas.Carteleras_idCarteleras')
            ->select('cronogramas.*','carteleras.descripcion as cartelera');
        
            
        return view('administracion.cronograma.create',["carteleras"=>$carteleras]);


    }
    public function store(DesignacionFormRequest $request,$idCartelera,$fecha){
        
        return Redirect::to('administracion/cronograma');        
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
        $cronograma=Cronograma::findOrFail($id);
        
        $cronograma->delete();
        return Redirect::to('administracion/cronograma');
    }
}
