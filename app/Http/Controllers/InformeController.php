<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attribute;
use App\Programa;

class InformeController extends Controller
{
	public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index(){
    	$facultades=Programa::where('tipo_programa_id',null)->where('programa_id',null)->pluck('descripcion','id');
    	$niveles_academicos=Attribute::where('type','1')->pluck('descripcion','id');
    	$modalidades=Attribute::where('type','2')->pluck('descripcion','id');
    	$linea_enfermeria=Attribute::where('type','18')->pluck('descripcion','id');
    	$prioridad=Attribute::where('type','19')->pluck('descripcion','id');
    	return view('registrar_informe.index',compact('facultades','niveles_academicos','modalidades','linea_enfermeria','prioridad'));
    }
}
