<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAwardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('awards', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('cv_id');
			$table->string('title', 100)->nullable();
			$table->string('award_month', 100)->nullable();
			$table->integer('award_year')->nullable();
			$table->integer('date')->nullable();
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
		Schema::drop('awards');
	}

}
