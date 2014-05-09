<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('info', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned();
			$table->string('title', 40);
			$table->string('first_name', 40);
			$table->string('last_name', 40);
			$table->enum('gender', array('Male', 'Female'));
			$table->date('date_of_birth')->nullable();
			$table->text('address');
			$table->text('country');
			$table->text('user_ip');
			$table->text('url')->nullable();
			$table->timestamps();
			$table->foreign('user_id')
					->references('id')->on('users')
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
		Schema::drop('info');
	}

}
