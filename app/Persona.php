<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model {

	protected $table = 'persona';
	protected $primaryKey = 'dni';
	protected $fillable = ['nombres', 'apellidos', 'codigo', 'genero'];
	public $timestamps = False;

}
