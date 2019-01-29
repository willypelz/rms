<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEducationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('educations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cv_id')->index('cv_id');
			$table->string('degree', 100)->nullable();
			$table->string('degree_class', 100);
			$table->string('grade', 50)->nullable();
			$table->string('course_of_study', 200)->nullable();
			$table->text('details', 65535)->nullable();
			$table->string('school', 200)->nullable()->index('school');
			$table->string('school_type', 100)->nullable();
			$table->string('city', 100)->nullable();
			$table->string('start_month', 20)->nullable();
			$table->integer('start_year')->nullable();
			$table->string('end_month', 20)->nullable();
			$table->integer('end_year')->nullable();
			$table->integer('start_date')->nullable();
			$table->boolean('still_school_here')->nullable();
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
		Schema::drop('educations');
	}

}
