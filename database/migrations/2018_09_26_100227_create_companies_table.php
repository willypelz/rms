<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('logo')->nullable();
			$table->string('phone', 50)->nullable();
			$table->string('email')->nullable();
			$table->boolean('is_email_visible')->nullable()->default(1);
			$table->string('website')->nullable();
			$table->text('about', 65535)->nullable();
			$table->text('address', 65535)->nullable();
			$table->integer('location_id')->nullable();
			$table->string('slug', 50)->nullable()->unique('slug');
			$table->dateTime('date_added')->nullable();
			$table->string('license_type', 50)->nullable()->default('TRIAL');
			$table->boolean('has_expired')->nullable()->default(0);
			$table->dateTime('valid_till')->nullable();
			$table->string('last_mail_sent')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('companies');
	}

}
