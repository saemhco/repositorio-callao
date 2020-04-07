<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	protected $primaryKey = 'id';
	protected $fillable = ['username','nombres','apellidos','email','rol'];
	// public $timestamps = True;  // Default
	protected $hidden = [
		'password', 'remember_token',
	];

	 public function descripcion_rol(){  
     	switch ($this->rol) {
     		case '0': $descripcion='Administrador'; break;
     		case '1': $descripcion='Registrador'; break;
     		default : $descripcion='Rol no definido'; break;
     	}
     	return $descripcion;
   }

}
