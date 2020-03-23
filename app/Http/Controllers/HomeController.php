<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attribute;
use App\Programa;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       //return $facultades=Programa::where('tipo_programa_id',null)->pluck('descripcion','id');
        //return view('registrar_informe.index',compact('facultades'));
    }
}
