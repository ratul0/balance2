<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_name', 40);
			$table->string('email', 40);
			$table->string('password');
			$table->integer('role_id')->unsigned();
			$table->integer('first_login')->unsigned()->default(0);
			$table->integer('distributor_status')->unsigned()->default(0);
			$table->integer('distributor_approve')->unsigned()->default(0);
			$table->integer('varification_status')->unsigned()->default(0);
			$table->string('varification_code',25)->nullable();
			$table->string('remember_token',100)->nullable();
			$table->timestamps();

			$table->foreign('role_id')
					->references('id')->on('roles')
					->onUpdate('cascade')
					->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
