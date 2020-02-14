<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	// protected $table = 'users';
	protected $primaryKey = 'dni';
	protected $fillable = ['nombres', 'apellidos', 'sexo'];
	public $timestamps = False;

	protected $hidden = [
		'password', 'remember_token'
	];

}
