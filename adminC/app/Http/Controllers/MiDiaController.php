<?php

namespace sisAdmin\Http\Controllers;

use Illuminate\Http\Request;

use sisAdmin\Http\Requests;
use DB;
use sisAdmin\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
class MiDiaController extends Controller
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
        $usuario = DB::table('users')       
        ->join('empleados','empleados.name','=','users.name') 
        ->select('users.*','empleados.idEmpleados as idEmpleado','empleados.turno as turno')
        ->where('users.name','=',\Auth::user()->name)
        ->first();

// ->join('carteleras','carteleras.idCarteleras','=','cronogramas.Carteleras_idCarteleras')
        $designacion=DB::table('designaciones')
        ->join('cronogramas','Cronogramas.idCronogramas','=','Cronogramas_idCronogramas')
        ->join('carteleras','carteleras.idCarteleras','=','cronogramas.Carteleras_idCarteleras')   
        ->where('designaciones.Empleados_idEmpleados','=',$usuario->idEmpleado)
        ->where('cronogramas.fecha','=',date('Y-m-d'))       
        ->select('designaciones.*','carteleras.horaInicio as horaInicio','carteleras.horaFin as horaFin','carteleras.cantidadPersonas as cant','carteleras.duracionRecorrido as duracionRecorrido')->first();

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
            
            for($c=0;$c<$colectivos;$c++){
                $HI=Carbon::createFromFormat('H:i:s',$horaInicio->toTimeString());
                $horarios[]=[
                    'colectivo'=>$numeroColectivo,
                    'inicio'=>$horaInicio->toTimeString(),
                    'fin'=> $HI->addSeconds($duracionRecorrido)->toTimeString(),               
                    ];
                $horaInicio=$horaInicio->addSeconds($intervaloColectivos);        
                $numeroColectivo++;
                    if($numeroColectivo == ($cantColectivos)+1){
                    $numeroColectivo=1;
                    }                    
            }

            if($usuario->turno==1){$inicio=0;}
            else{$inicio=(count($horarios))/2;}

            $miHorario=[];
            $cc=0;
            
        
            foreach($horarios as $hh){
                if($hh['colectivo'] == $designacion->orden && $cc>=$inicio && $cc <$inicio+(count($horarios))/2){
                    $matColectivo=DB::table('colectivos')->where('idColectivos','=',$designacion->Colectivos_idColectivos)->first();

                    $miHorario[]=[
                        'inicio'=>$hh['inicio'],
                        'colectivo'=>$matColectivo->matricula,
                        'fin'=>$hh['fin'],       
                    ];
                }
                $cc++;
            }

                
                // return view('chofer.midia.index');
                return view('chofer.midia.index',["designacion"=>$designacion,"miHorario"=>$miHorario]);
    }else{
         return view('chofer.midia.index',["designacion"=>$designacion]);
    }

    }
}
