<?php
namespace App\Http\Controllers;
use App\Persona;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PersonaImport;

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
	        $acciones="<div class='' align='center'>";
	        $acciones .= "<button type='button' class='btn btn-warning btn-circle' onclick='editar($dato->dni)'>
	                        <i class='fa fa-edit'></i></button> ";
	        $acciones .="<button type='button' class='btn btn-danger btn-circle' onclick='eliminar($dato->dni)'>
	                        <i class='fa fa-trash'></i></button>";
	        $acciones.="</div>";
	        $data['aaData'][] = [$dato->set_dni(), $dato->nombres, $dato->apellidos, $dato->descripcion_genero(), $acciones];
	     }
	     return json_encode($data, true); 
    }

    public function guardar_datos($r,$q){
    	$dni = str_pad($r->dni, 8, "0", STR_PAD_LEFT);
    	$q->dni=$dni;
    	$q->nombres=$r->nombres;
    	$q->apellidos=$r->apellidos;
    	$q->genero=$r->genero;
    	$q->save();
    }
    public function store(Request $r){
    	$dni = str_pad($r->dni, 8, "0", STR_PAD_LEFT);
    	$query=Persona::find($dni);
    	if($query)
            return array('resultado' => false,'msj'=>'El DNI ya está registrado en la Base de Datos.' );
    	$q = new Persona;
		$this->guardar_datos($r,$q);
    	return array('resultado' => true, 'msj'=>'Se registraron los datos.');
    }
    public function delete(Request $r){
    	$dni = str_pad($r->dni, 8, "0", STR_PAD_LEFT);
    	 Persona::destroy($dni);
    }
    public function edit($dni){
    	$dni = str_pad($dni, 8, "0", STR_PAD_LEFT);
    	return Persona::where('dni',$dni)->first();
   }
   public function update(Request $r){
   		$dni = str_pad($r->dni, 8, "0", STR_PAD_LEFT);
   		$id = str_pad($r->id, 8, "0", STR_PAD_LEFT);
   		$query=Persona::where('dni',$dni)->where('dni','<>',$id)->first();
        if($query)
            return array('resultado' => false,'msj'=>'El DNI ya está registrado en la Base de Datos.');
    	$q = Persona::where('dni',$id)->first();
    	$this->guardar_datos($r,$q);
    	return array('resultado' => true, 'msj'=>'Se actualizaron los datos.' );
   }

   public function importar(){
   		//return request()->file('file');
		Excel::import(new PersonaImport, request()->file('file'));
         //return 'exito';
	}
}
