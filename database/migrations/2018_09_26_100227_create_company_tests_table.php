<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyTestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company_tests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ats_product_id')->nullable();
			$table->integer('company_id')->nullable();
			$table->dateTime('date_added')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('company_tests');
	}

}
