<?php

namespace App\Http\Controllers;
use App\Persona;

use Illuminate\Http\Request;

class PersonaController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
        $this->data_null='{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';
    }

    public function index(){
    	return view('personas.persona.index');
    }

    public function data(){
	    $query = Persona::get();
	    
	    if($query->count()<1)
	        return $this->data_null;
	    
	    foreach ($query as $dato) {
	        $acciones="<div class=''>";
	        
	        $acciones .= "<button type='button' class='btn btn-warning btn-circle' onclick='editar($dato->id)'>
	                        <i class='fa fa-edit'></i></button> ";
	        $acciones .="<button type='button' class='btn btn-danger btn-circle' onclick='eliminar($dato->id)'>
	                        <i class='fa fa-trash'></i></button>";
	        $acciones.="</div>";
	        $data['aaData'][] = [$dato->dni, $dato->nombres, $dato->apellidos, $dato->descripcion_genero(), $acciones];
	     }
	     return json_encode($data, true); 
    }
}
