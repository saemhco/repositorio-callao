<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Programa;
use App\Ubigeo;
use DB;

class ReportController extends Controller {
   public function __construct(){
      // $this->middleware('auth')->except('index');
      $this->DB_TO_SELECT = [
         'informe.titulo'
      ];
   }
   public function index(){  // SEARCH - RESULT view
      $attr = $this->getAttributes();
      $facultades = Programa::where('nivel_acad_id',null)->pluck('descripcion','id');
      $escuela = Programa::where('nivel_acad_id','1')->where('programa_id','1')->pluck('descripcion','id');
      $ubigeo = Ubigeo::join('ubigeo AS prov','ubigeo.prov_id','=','prov.id')
               ->join('ubigeo AS dep','dep.id','=','ubigeo.dep_id')
               ->where('ubigeo.type','3')
               ->select(DB::raw("CONCAT(ubigeo.descripcion,' - ',prov.descripcion,' - ',dep.descripcion) AS descripcion"), 'ubigeo.id as ubigeo')
                ->pluck('descripcion','ubigeo');
      return view('buscador.buscador', compact('attr', 'facultades', 'escuela', 'ubigeo'));
   }

   private function saveInforme($data){  // SAVE REPORT
      return var_dump(false);
   }
   public function BasicSearch(Request $r){
      $params = $r->data;  // Get data from request
      $to_select = $this->DB_TO_SELECT;

      // Query
      $reg = DB::table('informe')->select($to_select);
      # PALABRA CLAVE
      $reg->where('informe.titulo', 'like', '%'.$params['keyword'].'%');

      $reg = $reg->get();
      return $reg;
      /* If we woudl like to search the keyword in more than one field we should use
      $query->orWhere('table.field_1', 'like', '%'.$keyword.'%')
         ->orWhere('table.field_2', 'like', '%'.$keyword.'%')
      */
   }
   public function IntermediateSearch(Request $r){
      $params = $r->data;  // Get data from request

      /*
      $params = [
         'keyword' => 'something to search for',
         'exposition' => [
            'from_date' => '',
            'to_date' => ''
         ],
         'author' => [
            'dni' => ''
         ],
         'program' => [
            'faculty' => '',
            'school' => '',
            'type' => ''
         ]
      ]; */
      $to_select = $this->DB_TO_SELECT;

      // Query
      $reg = DB::table('informe')->select($to_select);

      # PALABRA CLAVE
      if(key_exists('keyword', $params)){
         $reg->where('informe.titulo', 'like', '%'.$params['keyword'].'%');
      }
      # PRESENTACION
      if(key_exists('exposition', $params) && count($params['exposition'])!=0){
         $temp = $params['exposition'];
         # DESDE FECHA
         if(key_exists('from_date', $temp)){
            $reg->where('informe.fecha_sustentacion', '>=', $temp['from_date']);
         }
         # HASTA FECHA
         if(key_exists('to_date', $temp)){
            $reg->where('informe.fecha_sustentacion', '<=', $temp['to_date']);
         }
      }
      # AUTOR
      if(key_exists('author', $params) && count($params['author'])!=0){
         $temp = $params['author'];
         $flag = False;
         # DNI | NOMBRE | APELLIDOS
         if(key_exists('dni', $temp)){
            $reg->join('persona', function ($join) use ($temp){  // Join persona table to match author data
               if(strlen($temp['dni'])==8)
                  $join->on('persona.dni', 'like', DB::raw("'$temp[dni]%'"));  // First check dni
               else{
                  // Then check name and lastname
                  $join->on('persona.nombres', 'like', DB::raw("'%$temp[dni]%'"))
                  ->orOn('persona.apellidos', 'like', DB::raw("'%$temp[dni]%'"));
               }
            });
            $reg->join('autor', function($join){
               $join->on('autor.persona_id', '=', 'persona.dni')  // Persona has to be author
               ->on('autor.informe_id', '=', 'informe.id');
            });
            $flag = True;  // Author table is joined
            // If this field is not specified, the next fields will add author table
         }
         # CONDICION
         if(key_exists('condition', $temp)){
            if($flag) $reg->where('autor.condition', $temp['condition']);
            else $reg->join('autor', 'autor.condicion', '=', $temp['condition']);
         }
      }
      # PROGRAMA
      if(key_exists('program', $params) && count($params['program'])!=0){
         $temp = $params['program'];
         # ESCUELA
         if(key_exists('school', $temp)){  // If school is specified
            $reg->where('informe.programa_id', $temp['school']);
         }elseif(key_exists('faculty', $temp)){  // If only faculty is specified
            # FACULTAD
            $reg->join('programa', function($join) use ($temp){
               $join->on('informe.programa_id', '=', 'programa.id')
               ->on('programa.programa_id', '=', DB::raw("'$temp[faculty]%'"));
            });
            # NIVEL ACADEMICO
            if(key_exists('type', $temp)){
               $reg->where('programa.nivel_acad_id', $temp['type']);
            }
         }elseif(key_exists('type', $temp)){
            # NIVEL ACADEMICO
            $reg->join('programa', function($join) use ($temp){
               $join->on('informe.programa_id', '=', 'programa.id')
               ->on('programa.nivel_acad_id', DB::raw("'$temp[type]'"));
            });
         }
      }
      $reg = $reg->get(); // Get data

      return $reg;
   }
   public function AdvancedSearch(Request $r){
      $params = $r->data;  // Get data from request

      /* Values are Attribute's id
      $params = [
         'keyword' => 'something to search for',
         'product' => '',
         'exposition' => [
            'from_date' => '',
            'to_date' => ''
         ],
         'budget' => [
            'min' => '',
            'max' => '',
            'financed' => ''  // OTHER
         ],
         'author' => [
            'dni' => '',
            'condition' => ''
         ],
         'program' => [
            'faculty' => '',
            'school' => '',
            'type' => ''
         ],
         'research' => [
            'line' => '',
            'nature' => '',
            'approach' => '',
            'cut' => '',
            'temporality' => '',
            'design' => '',
            'level' => '',
            'population' => '',  // OTHER
            'sample' => '',  // OTHER
         ],
         'analysis_unity' => ['', ''],  // OTHER
         'place' => '',
         'area' => ''  // OTHER
      ]; */
      $to_select = $this->DB_TO_SELECT;

      // Query
      $reg = DB::table('informe')->select($to_select);

      /*** SPECIFIC FILTERS ***/
      # PALABRA CLAVE
      if(key_exists('keyword', $params)){
         $reg->where('informe.titulo', 'like', '%'.$params['keyword'].'%');
      }
      # PRODUCTO
      if(key_exists('product', $params)){
         $reg->where('informe.producto_id', $params['product']);
      }
      # LUGAR
      if(key_exists('place', $params)){
         $reg->where('informe.ubigeo_id', $params['place']);
      }
      # AREA
      if(key_exists('area', $params)){
         if( is_numeric($params['area']) ){  # LLAVE FORANEA
            $reg->where('informe.area_estudio_id', $params['area']);
         // }else{  # OTRO
         //    $reg->whereNull('informe.area_estudio_id');
         }
      }

      /*** ARRAY FILTERS ***/
      # PROGRAMA
      if(key_exists('program', $params) && count($params['program'])!=0){
         $temp = $params['program'];
         # ESCUELA
         if(key_exists('school', $temp)){  // If school is specified
            $reg->where('informe.programa_id', $temp['school']);
         }elseif(key_exists('faculty', $temp)){  // If only faculty is specified
            # FACULTAD
            $reg->join('programa', function($join) use ($temp){
               $join->on('informe.programa_id', '=', 'programa.id')
               ->on('programa.programa_id', '=', DB::raw("'$temp[faculty]%'"));
            });
            # NIVEL ACADEMICO
            if(key_exists('type', $temp)){
               $reg->where('programa.nivel_acad_id', $temp['type']);
            }
         }elseif(key_exists('type', $temp)){
            # NIVEL ACADEMICO
            $reg->join('programa', function($join) use ($temp){
               $join->on('informe.programa_id', '=', 'programa.id')
               ->on('programa.nivel_acad_id', DB::raw("'$temp[type]'"));
            });
         }
      }
      # INVESTIGACIÓN
      if(key_exists('research', $params) && count($params['research'])!=0){
         $temp = $params['research'];
         # LINEA
         if(key_exists('line', $temp)){
            $reg->where('informe.linea_id', $temp['line']);
         }
         # NATURALEZA
         if(key_exists('nature', $temp)){
            $reg->where('informe.naturaleza_id', $temp['nature']);
         }
         # ENFOQUE
         if(key_exists('approach', $temp)){
            $reg->where('informe.enfoque_id', $temp['approach']);
         }
         # CORTE
         if(key_exists('cut', $temp)){
            $reg->where('informe.corte_id', $temp['cut']);
         }
         # TEMPORALIDAD
         if(key_exists('temporality', $temp)){
            $reg->where('informe.temporalidad_id', $temp['temporality']);
         }
         # DISEÑO
         if(key_exists('design', $temp)){
            $reg->where('informe.diseno_id', $temp['design']);
         }
         # NIVEL
         if(key_exists('level', $temp)){
            $reg->where('informe.nivel_id', $temp['level']);
         }
         # POBLACIÓN
         if(key_exists('population', $temp)){
            if( is_numeric($temp['population']) ){  # LLAVE FORANEA
               $reg->where('informe.poblacion_id', $temp['population']);
            // }else{  # OTRO
            //    $reg->whereNull('informe.poblacion_id');
            }
         }
         # MUESTRA
         if(key_exists('sample', $temp)){
            if( is_numeric($temp['sample']) ){  # LLAVE FORANEA
               $reg->where('informe.muestra_id', $temp['sample']);
            // }else{  # OTRO
            //    $reg->whereNull('informe.muestra_id');
            }
         }
      }
      # UNIDAD DE ANALISIS
      if(key_exists('analysis_unity', $params) && count($params['analysis_unity'])!=0){
         if( is_array($params['analysis_unity']) ){  # LLAVES FORANEAS
            $reg->where(function($query) use ($params){
               foreach($params['analysis_unity'] as $v){
                  $query->orWhere('informe.unidad_analisis', 'like', "%$v%");
               }
            });
         // }else{  # OTRO
         //    $reg->whereNull('informe.unidad_analisis');
         }
      }

      /*** SPECIAL CASES ***/
      # PRESENTACION
      if(key_exists('exposition', $params) && count($params['exposition'])!=0){
         $temp = $params['exposition'];
         # DESDE FECHA
         if(key_exists('from_date', $temp)){
            $reg->where('informe.fecha_sustentacion', '>=', $temp['from_date']);
         }
         # HASTA FECHA
         if(key_exists('to_date', $temp)){
            $reg->where('informe.fecha_sustentacion', '<=', $temp['to_date']);
         }
      }
      # FONDO
      if(key_exists('budget', $params) && count($params['budget'])!=0){
         $temp = $params['budget'];
         # DESDE MONTO
         if(key_exists('min', $temp)){
            $reg->where('informe.presupuesto', '>=', $temp['min']);
         }
         # HASTA MONTO
         if(key_exists('max', $temp)){
            $reg->where('informe.presupuesto', '<=', $temp['max']);
         }
         # FINANCIADO POR
         if(key_exists('financed', $temp)){
            if( is_numeric($temp['financed']) ){  # LLAVE FORANEA
               $reg->where('informe.fuente_financiamiento_id', $temp['financed']);
            // }else{  # OTRO
            //    $reg->whereNull('informe.fuente_financiamiento_id');
            }
         }
      }
      # AUTOR
      if(key_exists('author', $params) && count($params['author'])!=0){
         $temp = $params['author'];
         $flag = False;
         # DNI | NOMBRE | APELLIDOS
         if(key_exists('dni', $temp)){
            $reg->join('persona', function ($join) use ($temp){  // Join persona table to match author data
               if(strlen($temp['dni'])==8)
                  $join->on('persona.dni', 'like', DB::raw("'$temp[dni]%'"));  // First check dni
               else{
                  // Then check name and lastname
                  $join->on('persona.nombres', 'like', DB::raw("'%$temp[dni]%'"))
                  ->orOn('persona.apellidos', 'like', DB::raw("'%$temp[dni]%'"));
               }
            });
            $reg->join('autor', function($join){
               $join->on('autor.persona_id', '=', 'persona.dni')  // Persona has to be author
               ->on('autor.informe_id', '=', 'informe.id');
            });
            $flag = True;  // Author table is joined
            // If this field is not specified, the next fields will add author table
         }
         # CONDICION
         if(key_exists('condition', $temp)){
            if($flag) $reg->where('autor.condition', $temp['condition']);
            else $reg->join('autor', 'autor.condicion', '=', $temp['condition']);
         }
      }
      // $reg = $reg->get(); // Get data

      // Get generated query
      DB::enableQueryLog();
      $reg = $reg->get(); // Get data
      return [DB::getQueryLog(), $reg];
      // return $reg;
   }
   public function getAttributes(){
      $attr = [  // Attribute types
			'tipo_programa' => [],
         'modalidad' => [],
         'prioridad' => [],
         'fuente_financiamiento' => [],
         'nivel' => [],
         'naturaleza' => [],
         'enfoque' => [],
         'corte' => [],
         'temporalidad' => [],
         'diseno' => [],
         'area_estudio' => [],
         'poblacion' => [],
         'muestra' => [],
         'unidad_analisis' => [],
         'producto' => [],
         'linea_fisica' => [],
         'linea_enfermeria' => [],
         'linea_general' => [],
         'condicion_autor' => [],
         'asesor' => [],
         'jurado_pregrado_seg_esp'=>[],
         'jurado_maestria_doctorado'=>[]
		];
      $_i = 1;
      foreach($attr as $k=>$at){
         $temp = DB::table('attribute')->where('type', $_i)->get();
         $attr[$k] = $temp;
         $_i++;
      }
      return $attr;
   }
   public function get_programa(Request $r){
      return  Programa::where('nivel_acad_id',$r->nivel_acad)->where('programa_id',$r->fac)->select('descripcion','id')->get();
   }
}
