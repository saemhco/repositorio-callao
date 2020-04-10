<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Attribute;
use App\Programa;
use App\Ubigeo;
use App\Persona;
use App\Informe;
use App\Autor;
use Auth;
use DB;

class InformeController extends Controller
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
      // Get ReportController class
      $attr = app(\App\Http\Controllers\ReportController::class);
      $attr = $attr->getAttributes();  // Get attributes from DB
      $facultades = Programa::where('nivel_acad_id',null)->pluck('descripcion','id');
      $ep = Programa::where('nivel_acad_id','1')->where('programa_id','1')->pluck('descripcion','id');
      $ubigeo = Ubigeo::join('ubigeo AS prov','ubigeo.prov_id','=','prov.id')
               ->join('ubigeo AS dep','dep.id','=','ubigeo.dep_id')
               ->where('ubigeo.type','3')
               ->select(DB::raw("CONCAT(ubigeo.descripcion,' - ',prov.descripcion,' - ',dep.descripcion) AS descripcion"), 'ubigeo.id as ubigeo')
                ->pluck('descripcion','ubigeo');
      //$persona=$this->get_persona()->pluck('datos','dni');
      //return $condicion_persona = $this->get_condicion_persona();
      return view('registrar_informe.index', compact('attr', 'facultades','ep','ubigeo'));
   }

   public function data(){
    $query = Informe::orderBy('id','desc')->get();
    
    if($query->count()<1)
        return $this->data_null;
    
    foreach ($query as $dato) {
        $acciones = "<div class='btn-group'>";
        $acciones .= "<a href='busqueda/$dato->id' target='_blank'  class='btn btn-success btn-circle'>
                        <i class='mdi mdi-launch'></i></a> ";
        $acciones .= "<button type='button' class='btn btn-info btn-circle' onclick='personas($dato->id,$dato->programa_id)'>
                        <i class='fa fa-users' ></i></button> ";
        if(!$dato->file){
        $acciones .= "<button type='button' class='btn waves-effect waves-light btn-outline-primary' onclick='press_btn_file($dato->id)'>
                        <i class='fa fa-upload'></i></button>";
        }else{
        $acciones .= "<label type='button' class='btn btn-primary btn-circle' onclick='press_btn_file($dato->id)'>
                        <i class='fa fa-upload'></i></label>";
        }//llamo a la f(x) para no dejar de usar el boton upload, ya que el label luce diferente
        $acciones .= "<button type='button' class='btn btn-warning btn-circle' onclick='editar($dato->id)'>
                        <i class='fa fa-edit'></i></button>";
        $acciones .="<button type='button' class='btn btn-danger btn-circle' onclick='eliminar($dato->id)'>
                        <i class='fa fa-trash'></i></button>";
        $acciones.="</div>";
        $data['aaData'][] = [$dato->titulo, $dato->autor(), $dato->programa->padre->descripcion, $dato->nivel_acad->descripcion,$dato->programa->descripcion, $acciones];
    }
    return json_encode($data, true);        
   }

    public function get_programa(Request $r){
     return  Programa::where('nivel_acad_id',$r->nivel_acad)->where('programa_id',$r->fac)->select('descripcion','id')->get();
   }

   public function get_personas(Request $r){
    $id=(int) $r->id;
    $personas = Autor::where('informe_id',$id)->pluck('persona_id');
    return Persona::select(DB::raw("CONCAT(dni,' ',nombres,' ',apellidos) AS datos"), 'dni')->whereNotIn('dni',$personas)->get();
   }

   public function get_tabla_personas(Request $r){
        $id=(int) $r->id;
        return Autor::select('persona.dni',DB::raw("CONCAT(persona.nombres,' ',persona.apellidos) AS datos"),'attribute.descripcion AS responsabilidad','autor.id','autor.informe_id AS informe_id')
                            ->join('persona','persona.dni','=','autor.persona_id')
                            ->join('attribute','attribute.id','=','autor.condicion_id')
                            ->where('autor.informe_id',$id)
                            ->get();
   }

   public function store_personas(Request $r){
        $q = new Autor;
        $q->informe_id = $r->informe_id;
        $q->persona_id = $r->persona_id;
        $q->condicion_id =$r->condicion_id;
        $q->save();
   }
   public function delete_persona(Request $r){
        Autor::destroy($r->id);
   }

   public function delete(Request $r){
        Informe::destroy($r->id);
   }


   public function get_condicion_persona($id){
        $id=(int) $id;
      return Attribute::whereIn('type',$id)->get();
   }
   public function set_jurado(Request $r){
      switch($r->prog){
        case '1': case '2': $type='21'; break;
        default: $type='22'; break;
      }
      return Attribute::where('type',$type)->get();
   }

   private function guardar_datos_informe($q,$r){
      $q->titulo=$r->titulo;
      $q->programa_id=$r->programa;
      $q->nivel_acad_id=$r->nivel_acad;
      $q->modalidad_id=$r->modalidad;
      $q->modalidad_id=$r->modalidad;
      $q->prioridad_id=$r->prioridad;
      $q->linea_id=$r->linea_general;
      $q->presupuesto=$r->presupuesto;
      $q->fuente_financiamiento_id=$r->fuente_financiamiento;
      $q->fuente_financiamiento_otro=$r->otra_fuente;
      $q->cronograma_inicio=$r->cronograma_inicio;
      $q->cronograma_fin=$r->cronograma_fin;
      $q->fecha_sustentacion=$r->fecha;
      $q->naturaleza_id=$r->naturaleza;
      $q->enfoque_id=$r->enfoque;
      $q->corte_id=$r->corte;
      $q->temporalidad_id=$r->temporalidad;
      $q->diseno_id=$r->disenio;
      $q->nivel_id=$r->nivel;
      $q->poblacion_id=$r->poblacion;
      $q->muestra_id=$r->muestra;
      if($r->unidad_analisis!=''){
        $q->unidad_analisis=implode(",",$r->unidad_analisis);  
      }
      $q->unidad_analisis_otro=$r->otro_unidad;
      $q->ubigeo_id=$r->ubigeo;
      $q->area_estudio_id=$r->area_estudio;
      $q->area_estudio_otro=$r->area_otros;
      $q->resumen=$r->resumen;
      $q->objetivos=$r->objetivos;
      $q->producto_id=$r->producto;
      $q->producto_otro=$r->producto_otro;
      $q->url=$r->url;
      $q->actualizado_por = Auth::user()->id;
      $q->save();
   }
   public function store(Request $r){
        //Buscar parecidos
        $query=Informe::where('titulo','like','%'.$r->titulo.'%')->first();
        if($query)
            return array('resultado' => false,'msj'=>'El título ya está registrado.' );
          $q = new Informe;
          $q->registrado_por = Auth::user()->id;
          $this->guardar_datos_informe($q,$r);
          return array('resultado' => true,
                        'msj'=>'Se registró una nueva investigación. Continúe registrando los datos del autor y otros (personas).',
                        'data'=>['programa'=>$q->programa_id,'id'=>$q->id]
                     );
   }
   public function edit($id){
    return Informe::select('informe.*','programa.programa_id AS facultad_id')
                    ->join('programa','programa.id','=','informe.programa_id')
                    ->where('informe.id',$id)->first();
   }

   public function update(Request $r){
        //Buscar parecidos
        $query=Informe::where('titulo','like','%'.$r->titulo.'%')->where('id','<>',$r->id)->first();
        if($query)
            return array('resultado' => false,'msj'=>'El título ya está registrado.' );
       $q = Informe::find($r->id);
       $this->guardar_datos_informe($q,$r);
       return array('resultado' => true,
                     'msj'=>'Se actualizó correctamente. Continúe con los datos del autor y otros (personas).',
                     'data'=>['programa'=>$q->programa_id,'id'=>$q->id]
                  );
   }

   public function save_file(Request $r){
        $q= Informe::find($r->id);
        //si se cargaron archivos que guarden las imagenes en el servidor
        if($r->file('file')){
            //Eliminamos el imagen que existía
            Storage::delete($q->file);
            $name= $r->file('file')->store('public/documentos');
            $q->file=$name;
            $q->save();
        }
   }

}
