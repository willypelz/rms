<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 100);
			$table->text('details', 65535);
			$table->string('location', 100)->nullable();
			$table->date('post_date')->nullable()->index('post_date');
			$table->date('expiry_date')->nullable()->index('expiry_date');
			$table->string('job_type', 100)->nullable();
			$table->string('job_level', 100)->nullable();
			$table->string('position', 100)->nullable();
			$table->text('qualification', 16777215);
			$table->text('experience', 16777215)->nullable();
			$table->boolean('video_posting_enabled')->nullable()->default(0);
			$table->text('video_posting_url', 65535)->nullable();
			$table->integer('company_id')->unsigned()->nullable()->index();
			$table->string('status')->default('1')->index('status')->comment('1:Draft, 2:Published, 3:Suspended, 4:Deleted');
			$table->dateTime('last_viewed_date')->nullable()->default('1970-01-01 00:00:00');
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
		Schema::drop('jobs');
	}

}
