<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model {

	protected $table = 'docente';
   protected $fillable = [
      'codigo', 'nombres', 'apellidos', 'programa_id'
   ];
	public $timestamps = False;

   public function programa(){
      return $this->belongsto(Programa::class, 'programa_id', 'id');
   }

}
