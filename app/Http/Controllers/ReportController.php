<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Informe;

class ReportController extends Controller {

   public function __construct(){
      $this->middleware('auth');
      $this->middleware('admin');
   }

   private function saveInforme($data){
      return False;
   }

}
