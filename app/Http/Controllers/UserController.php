<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Informe;
use App\Persona;
use App\User;

class UserController extends Controller {

   public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->data_null='{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';
    }

   public function index(){
      return view('personas.usuario.index');
   }
   public function data(){
       $query = User::where('rol','<>','0')->get();
       
       if($query->count()<1)
           return $this->data_null;
       
       foreach ($query as $dato) {
           $acciones="<div class='' align='center'>";
           $acciones .= "<button type='button' class='btn btn-warning btn-circle' onclick='editar($dato->id)'>
                           <i class='fa fa-edit'></i></button> ";
           $acciones .="<button type='button' class='btn btn-danger btn-circle' onclick='eliminar($dato->id)'>
                           <i class='fa fa-trash'></i></button>";
           $acciones.="</div>";
           $data['aaData'][] = [$dato->username, $dato->nombres, $dato->apellidos, $dato->email, $acciones];
        }
        return json_encode($data, true); 
    }

   public function store(Request $r){
      $query=User::find($r->username);
      if($query)
            return array('resultado' => false,'msj'=>'El usuario ya está registrado.' );
      $q = new User;
      $q->username=$r->username;
      $q->password= bcrypt($r->password);
      $this->guardar_datos($r,$q);
      return array('resultado' => true, 'msj'=>'Se registraron los datos.');
    }
   // CRUD
   public function guardar_datos($r,$q){
      $q->nombres=$r->nombres;
      $q->apellidos=$r->apellidos;
      $q->email=$r->email;
      $q->save();
   }
   public function edit($id){
      return User::find($id);
   }
   public function update(Request $r){
      $q = User::find($r->id);
      if($r->password)
         $q->password=bcrypt($r->password);
      $this->guardar_datos($r,$q);
      return array('resultado' => true, 'msj'=>'Se actualizaron los datos.' );
   }
   public function delete(Request $r){
      $query=Informe::where('registrado_por',$r->id)->orWhere('actualizado_por',$r->id)->first();
      if($query)
         return 0;
      $r = User::destroy($r->id);
      return 1;
   }
}
