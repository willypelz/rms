<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobTeamInvitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_team_invites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('name', 65535)->nullable();
			$table->text('email', 65535)->nullable();
			$table->integer('job_id')->nullable();
			$table->boolean('is_accepted')->nullable()->default(0);
			$table->boolean('is_declined')->nullable()->default(0);
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
		Schema::drop('job_team_invites');
	}

}
