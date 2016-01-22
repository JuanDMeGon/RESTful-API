<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\User;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		
		$this->call('FabricanteSeeder');
		$this->call('VehiculoSeeder');

		User::truncate();
		DB::table('oauth_clients')->truncate();
		$this->call('UserSeeder');
		$this->call('Oauth2Seeder');
	}

}
