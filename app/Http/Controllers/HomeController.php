<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attribute;
use App\Programa;
use App\Ubigeo;
use DB;

class HomeController extends Controller {
   public function __construct(){
      $this->middleware('auth');
   }


   public function index(){
      return  redirect()->route('informe.index');
   }
   
}
