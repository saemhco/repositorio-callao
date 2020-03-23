<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
   public function __construct(){
      $this->middleware('auth');
   }

   public function index(){
      // Get ReportController class
      $attr = app(\App\Http\Controllers\ReportController::class);
      $attr = $attr->getAttributes();  // Get attributes from DB
      return view('registrar_informe.index', compact('attr'));
   }
}
