<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExperiencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('experiences', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cv_id')->index('cv_id');
			$table->string('job_title', 300)->nullable();
			$table->integer('industry_id')->nullable();
			$table->string('company', 300)->nullable()->index('company');
			$table->string('city', 100)->nullable();
			$table->string('start_month', 20)->nullable();
			$table->integer('start_year')->nullable();
			$table->string('end_month', 20)->nullable();
			$table->integer('end_year')->nullable();
			$table->integer('start_date')->nullable();
			$table->boolean('still_work_here')->nullable();
			$table->string('start_time', 20)->nullable();
			$table->string('end_time', 20)->nullable();
			$table->string('accomplishments', 1000)->nullable();
			$table->timestamp('last_modified')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('experiences');
	}

}
