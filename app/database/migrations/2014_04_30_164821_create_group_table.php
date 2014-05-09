<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('category', 100);
			$table->integer('amount')->unsigned();
			$table->integer('distributor_id')->unsigned()->nullable();
			$table->timestamps();

			

			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('groups');
	}

}
