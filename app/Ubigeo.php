<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubigeo extends Model {

	protected $table = 'ubigeo';
   	protected $primaryKey = 'id';
   	protected $fillable = ['id','type','descripcion','prov_id','dep_id'];
	public $timestamps = False;

	public function provincia(){  
      return $this->belongsto(Ubigeo::class, 'prov_id', 'id');
   }
   public function departamento(){  
      return $this->belongsto(Ubigeo::class, 'dep_id', 'id');
   }

}
