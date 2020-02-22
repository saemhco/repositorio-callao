<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model {

	protected $table = 'autor';
   protected $primaryKey = 'persona_id';
   protected $fillable = ['informe_id', 'condicion_id'];
	public $timestamps = False;


   public function persona(){  // PERSONA fk
      return $this->belongsto(Persona::class, 'persona_id', 'dni');
   }
   public function informe(){  // INFORME fk
      return $this->belongsto(Informe::class, 'informe_id', 'id');
   }
   public function condicion(){  // CONDICION fk
      return $this->belongsto(Condicion::class, 'condicion_id', 'id');
   }

}
