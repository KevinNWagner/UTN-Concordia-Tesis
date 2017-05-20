<?php

namespace sisAdmin\Http\Controllers;

use Illuminate\Http\Request;

use sisAdmin\Http\Requests;

class AdminMenuController extends Controller
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
       return view('administracion.home.index');
    }
}
