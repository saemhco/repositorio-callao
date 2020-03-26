<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model {

	protected $table = 'ubigeo';
   protected $primaryKey = 'id';
   protected $fillable = ['type','descripcion','prov_id','dep_id'];
	public $timestamps = False;

}
