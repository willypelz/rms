<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCvCreditsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cv_credits', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->nullable()->unique('user_id');
			$table->integer('credits')->nullable();
			$table->integer('total_bought')->nullable();
			$table->integer('total_used')->nullable();
			$table->dateTime('last_bought_date')->nullable();
			$table->dateTime('last_used_date')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cv_credits');
	}

}
