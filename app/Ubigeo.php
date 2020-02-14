<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model {

	protected $table = 'ubigeo';
   protected $primaryKey = 'id';
   protected $fillable = ['ubigeo', 'descripcion'];
	public $timestamps = False;

}
