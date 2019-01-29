<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAtsProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ats_products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ats_service_id')->nullable();
			$table->integer('ats_provider_id')->nullable();
			$table->integer('company_id')->nullable();
			$table->string('name', 100)->nullable();
			$table->text('summary', 65535)->nullable();
			$table->text('details', 65535)->nullable();
			$table->float('cost', 10, 0)->nullable();
			$table->float('discount', 10, 0)->nullable();
			$table->boolean('active')->default(1);
			$table->integer('order')->default(0);
			$table->dateTime('created')->nullable();
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
		Schema::drop('ats_products');
	}

}
