<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attribute;
use App\Programa;
use App\Ubigeo;
use App\Persona;
use DB;

class InformeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      // Get ReportController class
      $attr = app(\App\Http\Controllers\ReportController::class);
      $attr = $attr->getAttributes();  // Get attributes from DB
      $facultades = Programa::where('tipo_programa_id',null)->pluck('descripcion','id');
      $ep = Programa::where('tipo_programa_id','1')->where('programa_id','1')->pluck('descripcion','id');
      $ubigeo = Ubigeo::join('ubigeo AS prov','ubigeo.prov_id','=','prov.id')
               ->join('ubigeo AS dep','dep.id','=','ubigeo.dep_id')
               ->where('ubigeo.type','3')
               ->select(DB::raw("CONCAT(ubigeo.descripcion,' - ',prov.descripcion,' - ',dep.descripcion) AS descripcion"), 'ubigeo.id as ubigeo')
                ->pluck('descripcion','ubigeo');
      $persona=$this->get_persona()->pluck('datos','dni');
      //return $condicion_persona = $this->get_condicion_persona();
      return view('registrar_informe.index', compact('attr', 'facultades','ep','ubigeo','persona'));
   }

    public function detalle_programa(Request $r){
     return  Programa::where('tipo_programa_id',$r->prog)->where('programa_id',$r->fac)->select('descripcion','id')->get();
   }

   public function get_persona(){
    return Persona::select(DB::raw("CONCAT(codigo,' ',nombres,' ',apellidos) AS datos"), 'dni')->get();
   }

   public function get_condicion_persona($id){
      return Attribute::whereIn('type',$id)->get();
   }
   public function set_jurado(Request $r){
      switch($r->prog){
        case '1': case '2': $type='21'; break;
        default: $type='22'; break;
      }
      return Attribute::where('type',$type)->get();
   }
}
