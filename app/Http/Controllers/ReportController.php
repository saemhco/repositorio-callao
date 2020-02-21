<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Informe;
use DB;

class ReportController extends Controller {

   public function __construct(){
      $this->middleware('auth');
      $this->middleware('admin');
   }

   private function saveInforme($data){
      return False;
   }

   private function BasicSearch($keyword){  // $keyword = 'something to search for'
      return False;
   }

   private function IntermediateSearch($params){
      /* $params = [
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
      ] */
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
         # DNI
         if(key_exists('dni', $temp)){
            $reg->join('autor', 'autor.dni', '=', $temp['dni']);
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
            $reg->where('informe.programa_id', $temp['faculty']);
         }
      }
      return var_dump($reg);
   }

   private function AdvancedSearch($params){
      /* Values are Attribute's id
      $params = [
         'product' => ''
         'exposition' => [
            'from_date' => '',
            'to_date' => ''
         ],
         'budget' => [
            'min' => '',
            'max' => '',
            'financed' => ''
         ],
         'author' => [
            'dni' => '',
            'condition' => ''
         ],
         'program' => [
            'faculty' => '',
            'school' => '',
            'type' => '',
            'program' => ''  // ¿###?
         ]
         'research' => [
            'line' => '',
            'nature' => '',
            'approach' => '',
            'cut' => '',
            'temporality' => '',
            'design' => '',
            'level' => '',
            'population' => '',
            'sample' => ''
         ]
         'analysis_unity' => ['']
         'place' => ''
         'area' => ''
      ] */
      $to_select = [
         'persona.nombre'
      ];

      // Query
      $reg = DB::table($_table)->select($to_select);

      /*** SPECIFIC FILTERS ***/
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
         $reg->where('informe.area_estudio_id', $params['area']);
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
            $reg->where('informe.programa_id', $temp['faculty']);
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
            $reg->where('informe.poblacion_id', $temp['population']);
         }
         # MUESTRA
         if(key_exists('sample', $temp)){
            $reg->where('informe.muestra_id', $temp['sample']);
         }
      }
      # UNIDAD DE ANALISIS
      if(key_exists('analysis_unity', $params) && count($params['analysis_unity'])!=0){
         $reg->whereIn('informe.analysis_unity', $params['analysis_unity']);
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
            $reg->where('informe.fuente_financiamiento_id', '<=', $temp['financed']);
         }
      }
      # AUTOR
      if(key_exists('author', $params) && count($params['author'])!=0){
         $temp = $params['author'];
         $flag = False;
         # DNI
         if(key_exists('dni', $temp)){
            $reg->join('autor', 'autor.dni', '=', $temp['dni']);
            $flag = True;  // Author table is joined
            // If this field is not specified, the next fields will add author table
         }
         # CONDICION
         if(key_exists('condition', $temp)){
            if($flag) $reg->where('autor.condition', $temp['condition']);
            else $reg->join('autor', 'autor.condicion', '=', $temp['condition']);
         }
      }
      $reg = $reg->get(); // Get data

      return var_dump($reg);
   }
}
