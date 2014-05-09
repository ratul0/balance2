<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pins', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('pin', 100);
			$table->integer('amount')->unsigned();
			$table->integer('status')->unsigned()->default(1);
			$table->string('category', 100);
			$table->integer('distributor_id')->unsigned()->nullable();
			$table->integer('client_id')->unsigned()->nullable();
			$table->timestamps();

			$table->foreign('client_id')
					->references('id')->on('users')
					->onUpdate('cascade')
					->onDelete('cascade');
			$table->foreign('distributor_id')
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
		Schema::drop('pins');
	}

}
