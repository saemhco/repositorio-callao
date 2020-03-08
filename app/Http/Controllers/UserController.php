<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Informe;
use App\Persona;

class UserController extends Controller {

   public function __construct(){
      $this->middleware('auth');
   }
   public function index(){
      return view('register.user');
   }
   // CRUD
   public function create(Request $r){ // With request
      $params = $r->data;
      $new = New Persona;
      // Set attributes values
      $new->dni = $params['dni'];
      $new->nombres = $params['nombres'];
      $new->apellidos = $params['apellidos'];
      $new->codigo = $params['codigo'];
      $new->genero = $params['genero'] === "M";
      $res = $new->save(); // Save changes to DB
      return $new;

      return $res ? "Alright":"Something went wrong";
      if($res){
         return true;
         return "alright";
      }else{
         // Show results of log
         return false;
         DB::enableQueryLog(); // Enable query log
         return print_r(DB::getQueryLog());
      }
   }
   private function read($id){
      $reg = Persona::get($id);
      return $reg;
   }
   private function update($params){
      /* $params = [
         'id' => "",
         'dni' => "",
         'nombres' => "",
         'apellidos' => "",
         'codigo' => "",
         'genero' => "",
      ];*/
      $reg = Persona::get($params['id']);
      foreach($params as $field=>$param){
         // Change each parameter
         $reg->$field = $param;
      }
      $reg->save(); // Save changes
      return true;
   }
   private function delete($id){
      $r = Persona::destroy($id);
      return true;
   }
}
