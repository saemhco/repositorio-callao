<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model {

   protected $primaryKey = 'id'
   protected $fillable = ['user_id', 'informe_id', 'condicion_autor']


   public function user(){  // USER fk
      return $this->belongsto(User::class, 'user_id', 'dni');
   }
   public function informe(){  // INFORME fk
      return $this->belongsto(Informe::class, 'informe_id', 'id');
   }

}
