<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PinsTableSeeder extends Seeder {

	public function run()
	{
		$pins = array(
			array(
				'pin'  =>"123456789123456",
				'amount'	=>	100,
				'category'	=>	'test',
				'created_at' => date('Y-m-d H-i-s'),
				'updated_at' => date('Y-m-d H-i-s')
			)
		);

		DB::table('pins')->insert($pins);
	}

}