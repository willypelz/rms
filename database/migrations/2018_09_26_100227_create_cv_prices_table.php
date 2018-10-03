<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCvPricesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cv_prices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cv_amount')->nullable();
			$table->float('price', 10, 0)->nullable();
			$table->text('details', 65535)->nullable();
			$table->dateTime('modified')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cv_prices');
	}

}
