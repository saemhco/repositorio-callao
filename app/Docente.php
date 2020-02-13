<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model {

   protected $fillable = [
      'codigo', 'nombres', 'apellidos', 'programa_id'
   ]

   public function programa(){
      return $this->belongsto(Programa::class, 'programa_id', 'id');
   }

}
