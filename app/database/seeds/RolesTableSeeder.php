<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RolesTableSeeder extends Seeder {

	public function run()
	{
		$roles = array(
			array('name' =>'Admin'),
			array('name' =>'distributor'),
			
			array('name' =>'client')
		);

		DB::table('roles')->insert($roles);
	}

}