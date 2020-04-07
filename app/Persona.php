<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model {

	protected $table = 'persona';
	protected $primaryKey = 'dni';
	protected $fillable = ['dni','nombres', 'apellidos', 'codigo', 'genero'];
	public $timestamps = False;

	public function descripcion_genero(){
		switch ($this->genero) {
			case '0': return "Femenino"; break;
			case '1': return "Masculino"; break;
			default: return "No definido"; break;
		}
	}

	public function set_dni(){
		return str_pad($this->dni, 8, "0", STR_PAD_LEFT);
	}

}
