<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormFieldsValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_fields_values', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('form_field_id')->nullable()->index('form_field_id');
			$table->text('value', 65535)->nullable();
			$table->integer('job_application_id')->nullable()->index('jobapplicationid');
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
		Schema::drop('form_fields_values');
	}

}
