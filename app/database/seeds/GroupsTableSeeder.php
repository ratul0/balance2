<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class GroupsTableSeeder extends Seeder {

	public function run()
	{
		$groups = array(
			array(
				'category'	=>	'test',
				'amount'	=>	1,
				'created_at' => date('Y-m-d H-i-s'),
				'updated_at' => date('Y-m-d H-i-s')
			)
		);

		DB::table('groups')->insert($groups);
	}

}