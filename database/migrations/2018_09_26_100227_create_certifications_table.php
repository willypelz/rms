<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCertificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('certifications', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cv_id')->index('cv_id');
			$table->string('title', 100)->nullable();
			$table->string('start_time', 30)->nullable();
			$table->string('end_time', 30)->nullable();
			$table->string('description', 300)->nullable();
			$table->timestamp('last_modified')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->unique(['title','cv_id'], 'title');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('certifications');
	}

}
