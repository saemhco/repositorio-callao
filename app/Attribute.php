<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {

	protected $table = 'attribute';
   	protected $primaryKey = 'id';
   	protected $fillable = ['type', 'descripcion'];
	public $timestamps = False;

}
