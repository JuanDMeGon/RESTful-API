<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class Verificador extends Controller
{
    public function verificar($usuario, $contrasena)
    {
    	$credentials =
    	[
        	'email'    => $usuario,
        	'password' => $contrasena,
      	];

      	if(Auth::once($credentials))
      	{
        	return Auth::user()->id;
      	}

      	return false;
    }
}
