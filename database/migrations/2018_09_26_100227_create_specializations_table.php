<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpecializationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('specializations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100)->default('');
			$table->boolean('active');
			$table->dateTime('modified')->nullable();
			$table->string('slug')->nullable();
			$table->integer('parent_id')->nullable();
			$table->string('icon')->nullable();
			$table->string('seo_title')->nullable();
			$table->text('seo_keywords', 65535)->nullable();
			$table->text('seo_description', 65535)->nullable();
			$table->text('description', 65535)->nullable();
			$table->text('jobs_meta_keywords', 65535)->nullable();
			$table->text('jobs_meta_description', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('specializations');
	}

}
