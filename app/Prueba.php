<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
	public function saludar($nombre)
	{
		return "hola $nombre";
	}
}