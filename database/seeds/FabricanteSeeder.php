<?php

use Illuminate\Database\Seeder;
use App\Fabricante;
use Faker\Factory as Faker;

class FabricanteSeeder extends Seeder 
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker::create();
		for($i = 0; $i < 3; $i++)
		{
			Fabricante::create
			([
				'nombre' => $faker->word(),
				'telefono' => $faker->randomNumber(7)
			]);
		}
	}
}
