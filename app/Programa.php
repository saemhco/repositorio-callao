<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model {

   protected $primaryKey = 'id'
   protected $fillable = [
      'descripcion',  // Nombre
      'tipo_programa_id',  // Tipo de programa (facultad, escuela, maestria, doctorado, especialidad)
      'programa_id'  // Opcional, referencia otro registro de Programa
   ]

   public function padre(){
      return $this->belongsto(Program::class, 'programa_id', 'id')
   }

}
