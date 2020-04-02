<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model {

	protected $table = 'programa';
   protected $primaryKey = 'id';
   protected $fillable = [
      'descripcion',  // Nombre
      'nivel_acad_id',  // Nivel Académico (facultad, escuela, maestria, doctorado, especialidad)
      'programa_id'  // Opcional, referencia otro registro de Programa
   ];
	public $timestamps = False;

   public function padre(){
      return $this->belongsto(Programa::class, 'programa_id', 'id');
   }

}
