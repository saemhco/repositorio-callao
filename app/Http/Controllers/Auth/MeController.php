<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class MeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $r)
    {
        $user = User::find(Auth::user()->id);
        $user->nombres=$r->nombres;
        $user->apellidos=$r->apellidos;
        $user->email=$r->email;
        if($r->password)
            $user->password= bcrypt($r->password);
        $user->save();

    }
}
