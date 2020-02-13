<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model {

   protected $fillable = [
      'codigo', 'nombres', 'apellidos',
      'programa_id'
   ]

}
