<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssociationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('associations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cv_id');
			$table->string('title', 100)->nullable();
			$table->string('start_month', 100)->nullable();
			$table->integer('start_year')->nullable();
			$table->string('end_month', 100)->nullable();
			$table->integer('end_year')->nullable();
			$table->integer('start_date')->nullable();
			$table->boolean('still_work_here')->nullable();
			$table->string('description', 300)->nullable();
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
		Schema::drop('associations');
	}

}
