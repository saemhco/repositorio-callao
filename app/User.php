<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    protected $primaryKey = 'dni';
    protected $fillable = ['nombres', 'apellidos','email', 'fecha_nacimiento', 'sexo','rol'];
    protected $hidden = [
        'password', 'remember_token',
    ];

}
