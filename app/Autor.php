<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model {

	protected $table = 'autor';
   protected $primaryKey = 'id';
   protected $fillable = ['alumno', 'docente', 'informe_id', 'condicion_id', 'genero'];
	public $timestamps = False;


   public function docente(){  // DOCENTE fk
      return $this->belongsto(Docente::class, 'docente', 'codigo');
   }
   public function alumno(){  // USER fk
      return $this->belongsto(Alumno::class, 'alumno', 'codigo');
   }
   public function informe(){  // INFORME fk
      return $this->belongsto(Informe::class, 'informe_id', 'id');
   }
   public function condicion(){  // CONDICION fk
      return $this->belongsto(Condicion::class, 'condicion_id', 'id');
   }

}
