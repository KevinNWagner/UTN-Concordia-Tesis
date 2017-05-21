<?php

namespace sisAdmin\Http\Controllers;

use Illuminate\Http\Request;

use sisAdmin\Http\Requests;
use sisAdmin\User;
use DB;

class Redirect extends Controller
{

    public function __construct()
    {
       
    }

    
    public function tipo()
    {
        $usuario = DB::table('users')
        ->select('users.*')
        ->where('name','=',\Auth::user()->name)
        ->first();

        switch($usuario->Tipos_idTipos){
            case 1;            
                return redirect('administracion/home');
                break;         
            case 2;            
                return redirect('chofer/home');
                break;        
            case 3;            
                return redirect('inspector/home');
                break;        
        }

        return redirect('auth/login');
    }
}
