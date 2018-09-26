<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAtsServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ats_services', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100)->default('');
			$table->text('description', 65535)->nullable();
			$table->string('type', 100)->nullable()->default('');
			$table->boolean('active')->default(1);
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
		Schema::drop('ats_services');
	}

}
