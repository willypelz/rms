<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAtsProvidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ats_providers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->default('');
			$table->text('address', 65535)->nullable();
			$table->string('phone', 25)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('logo', 100)->nullable();
			$table->text('website', 65535)->nullable();
			$table->string('username', 100)->nullable();
			$table->string('password', 40)->nullable();
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
		Schema::drop('ats_providers');
	}

}
