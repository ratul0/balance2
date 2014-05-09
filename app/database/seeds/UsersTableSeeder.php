<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$users = array(
			array(
				'user_name'  =>'Admin',
				'email'      =>'admin@infancy.com',
				'password'   => Hash::make('admin'),
				'role_id'    => 1,
				'varification_status'	=> 1,
				'created_at' => date('Y-m-d H-i-s'),
				'updated_at' => date('Y-m-d H-i-s')
			),
			
			array(
				'user_name'  =>'distributor',
				'email'      =>'distributor@infancy.com',
				'password'   => Hash::make('distributor'),
				'role_id'    => 2,
				'varification_status'	=> 0,
				'created_at' => date('Y-m-d H-i-s'),
				'updated_at' => date('Y-m-d H-i-s')
			),
			array(
				'user_name'  =>'client',
				'email'      =>'client@infancy.com',
				'password'   => Hash::make('client'),
				'role_id'    => 3,
				'varification_status'	=> 0,
				'created_at' => date('Y-m-d H-i-s'),
				'updated_at' => date('Y-m-d H-i-s')
			)
		);

		DB::table('users')->insert($users);
	}

}