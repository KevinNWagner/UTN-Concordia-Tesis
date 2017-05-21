<?php

namespace sisAdmin\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use sisAdmin\Http\Requests;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class HoyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

// ->join('carteleras','carteleras.idCarteleras','=','cronogramas.Carteleras_idCarteleras')
        $designacion=DB::table('designaciones')
        ->join('cronogramas','Cronogramas.idCronogramas','=','Cronogramas_idCronogramas')
        ->join('carteleras','carteleras.idCarteleras','=','cronogramas.Carteleras_idCarteleras')           
        ->where('cronogramas.fecha','=',date('Y-m-d'))       
        ->select('designaciones.*','designaciones.Empleados_idEmpleados as idEmpleado','carteleras.horaInicio as horaInicio','carteleras.horaFin as horaFin','carteleras.cantidadPersonas as cant','carteleras.duracionRecorrido as duracionRecorrido')->first();

// Parametro de cronograma.create 
    // @for($count=1;$count<$cartelera->cantidadPersonas/800;$count++)
    if($designacion){
            $horaInicio=Carbon::createFromFormat('H:i:s',$designacion->horaInicio);
            $horaFin=Carbon::createFromFormat('H:i:s',$designacion->horaFin);    
            $duracionTotal = $horaInicio->diffInSeconds($horaFin); // EN SEGUNDOS
            $cantColectivos = round($designacion->cant/800);
            $dr = Carbon::createFromFormat('H:i:s',$designacion->duracionRecorrido);
            $duracionRecorrido=($dr->hour*60*60+$dr->minute*60); // EN SEGUNDOS
            $intervaloColectivos = $duracionRecorrido/$cantColectivos; // EN SEGUNDOS
            $colectivos =  $cantColectivos * round(($duracionTotal/$duracionRecorrido));

            $horarios=[];
            $numeroColectivo=1;
            $turno = 1;
            
            for($c=0;$c<$colectivos;$c++){
                $HI=Carbon::createFromFormat('H:i:s',$horaInicio->toTimeString());
                $horarios[]=[
                    'turno'=>$turno,
                    'orden'=>$numeroColectivo,
                    'inicio'=>$horaInicio->toTimeString(),
                    'fin'=> $HI->addSeconds($duracionRecorrido)->toTimeString(),               
                    ];
                $horaInicio=$horaInicio->addSeconds($intervaloColectivos);        
                $numeroColectivo++;
                    if($numeroColectivo == ($cantColectivos)+1){
                        $numeroColectivo=1;
                    }        
                    if($c == ($colectivos/2)){
                        $turno=2;
                    }            
            }

            
            

            $miHorario=[];
            $cc=0;
            
          
            foreach($horarios as $hh){
                $miHorario[]=[
                        'inicio'=>$hh['inicio'],
                        'empleado'=>$this->getNombre($hh['orden'],date('Y-m-d'),$hh['turno']),
                        'colectivo'=>$this->getColectivo($hh['orden'],date('Y-m-d')),
                        'fin'=>$hh['fin'],       
                    ];
            }

           // $horariosP = $this->paginate($miHorario,7);
            

                
                // return view('chofer.midia.index');
                return view('administracion.hoy.index',["designacion"=>$designacion,"miHorario"=>$miHorario]);
    }else{
         return view('administracion.hoy.index',["designacion"=>$designacion]);
    }

    }

    function getNombre($orden,$date,$turno){             

            $designacion=DB::table('designaciones')
            ->join('cronogramas','Cronogramas.idCronogramas','=','Cronogramas_idCronogramas')
            ->join('empleados','empleados.idEmpleados','=','designaciones.Empleados_idEmpleados')                             
            ->where('designaciones.orden','=',$orden)
            ->where('cronogramas.fecha','=',$date)
            ->select('empleados.nombre as nombre','empleados.apellido as apellido')->first();
        
            if($turno==2){
                $designacion=DB::table('designaciones')
                ->join('cronogramas','Cronogramas.idCronogramas','=','Cronogramas_idCronogramas')
                ->join('empleados','empleados.idEmpleados','=','designaciones.Empleados_idEmpleados')                             
                ->where('designaciones.orden','=',$orden)
                ->where('cronogramas.fecha','=',$date)
                ->orderBy('designaciones.idDesignaciones', 'desc')
                ->select('empleados.nombre as nombre','empleados.apellido as apellido')->first();                
            }

            return ($designacion->nombre.' '.$designacion->apellido);

    }
    function getColectivo($orden,$date){
            $designacion=DB::table('designaciones')
            ->join('cronogramas','Cronogramas.idCronogramas','=','Cronogramas_idCronogramas')     
            ->join('colectivos','colectivos.idColectivos','=','designaciones.Colectivos_idColectivos')           
            ->where('cronogramas.fecha','=',$date)
            ->where('designaciones.orden','=',$orden)
            ->select('colectivos.matricula as matricula','colectivos.idColectivos as id')->first();

            return ($designacion->matricula);
            
    }

    public function paginate($items,$perPage)
    {
    $pageStart = \Request::get('page', 1);
    // Start displaying items from this number;
    $offSet = ($pageStart * $perPage) - $perPage; 

    // Get only the items you need using array_slice
    $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);

    return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }

}

