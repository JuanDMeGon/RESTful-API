<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class Oauth2Seeder extends Seeder 
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for($i = 1; $i <= 10; $i++)
		{
			DB::table('oauth_clients')->insert
			([
				'id'=> "id$i",
				'secret' => "secret$i",
				'name' => 'cliente$i'
			]);
		}
	}
}
