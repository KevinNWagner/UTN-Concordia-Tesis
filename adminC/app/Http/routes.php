<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// ultimo

Route::get('/', function () {
    return view('auth/login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'userSuperAdmin'], function () {
        Route::get('/home/index', 'HomeController@index');   
        Route::resource('administracion/cartelera','CarteleraController');
        Route::resource('administracion/colectivo','ColectivoController');
        Route::resource('administracion/empleado','EmpleadoController');
        Route::resource('administracion/tipo','TipoController');
    });

    Route::group(['middleware' => 'userAdmin'], function () {
        Route::resource('administracion/hoy','HoyController');
        Route::get('administracion/home','AdminMenuController@index');
        Route::resource('administracion/colectivo','ColectivoController');
        Route::resource('administracion/empleado','EmpleadoController');
        Route::resource('administracion/cronograma','CronogramaController');
        Route::resource('administracion/cartelera','CarteleraController');
        Route::resource('administracion/rendicion','RendicionAdministracionController');
        Route::post('administracion/cronograma/{idCartelera}/{fecha}/storeDesignacion','CronogramaController@storeDesignacion');
    });

   Route::group(['middleware' => 'userChofer'], function () {
        Route::resource('chofer/midia','MiDiaController');
        Route::resource('chofer/home','ChoferMenuController');
        Route::resource('chofer/rendicion','rendicionChoferController');

        });
Route::group(['middleware' => 'userInspector'], function () {
        
        Route::resource('inspector/home','InspectorMenuController');
        Route::resource('inspector/reportes','ReporteController');

        });


Route::get('/home', 'Redirect@tipo');    
});

Route::auth();








