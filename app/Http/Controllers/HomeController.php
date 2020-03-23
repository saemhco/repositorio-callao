<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attribute;
use App\Programa;

class HomeController extends Controller {
   public function __construct(){
      $this->middleware('auth');
   }


   public function index(){
      // Get ReportController class
      $attr = app(\App\Http\Controllers\ReportController::class);
      $attr = $attr->getAttributes();  // Get attributes from DB
      $facultades = Programa::where('tipo_programa_id',null)->pluck('descripcion','id');
      return view('registrar_informe.index', compact('attr', 'facultades'));
   }
}
