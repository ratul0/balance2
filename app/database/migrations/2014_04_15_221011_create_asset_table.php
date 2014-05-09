<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asset', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('client_id')->unsigned()->nullable();
			$table->integer('distributor_id')->unsigned()->nullable();
			$table->integer('money')->unsigned()->default(0);
			$table->string('pin', 100);
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
		Schema::drop('asset');
	}

}
