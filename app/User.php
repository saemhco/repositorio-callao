<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
	use Notifiable;

	protected $primaryKey = 'id';
	protected $fillable = ['username','email','rol'];
	// public $timestamps = True;  // Default
	protected $hidden = [
		'password', 'remember_token',
	];

}
