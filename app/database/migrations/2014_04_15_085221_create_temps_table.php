<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('temps', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_name', 40);
			$table->string('email', 40);
			$table->string('password');
			$table->integer('role_id')->unsigned();
			$table->integer('varification_status')->unsigned()->default(0);
			$table->string('varification_code',25)->nullable();
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
		Schema::drop('temps');
	}

}
