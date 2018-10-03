<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCvsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cvs', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('first_name', 100)->nullable();
			$table->string('last_name', 100)->nullable();
			$table->string('other_name', 100)->nullable();
			$table->string('headline', 200)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('phone', 100)->nullable();
			$table->string('gender', 10)->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('religion', 25)->nullable();
			$table->string('state_of_origin')->nullable();
			$table->boolean('willing_to_relocate')->nullable();
			$table->string('marital_status', 25)->nullable();
			$table->integer('experience')->nullable();
			$table->string('street', 250)->nullable();
			$table->string('city', 100)->nullable();
			$table->string('state', 100)->nullable();
			$table->string('summary', 1000)->nullable();
			$table->text('tagline', 65535)->nullable();
			$table->string('display_picture')->default('default-profile.png');
			$table->string('highest_qualification')->nullable();
			$table->string('last_position')->nullable();
			$table->string('last_company_worked')->nullable();
			$table->integer('years_of_experience')->nullable();
			$table->text('pref_locations', 65535)->nullable();
			$table->string('skills', 1000)->nullable();
			$table->string('others', 1000)->nullable();
			$table->integer('rank')->default(1);
			$table->text('cv_file', 65535)->nullable();
			$table->text('extracted_content', 65535)->nullable();
			$table->string('cv_source')->default('Direct Application');
			$table->dateTime('uploaded_date')->nullable();
			$table->integer('uploaded_by')->unsigned()->nullable()->index();
			$table->timestamp('last_modified')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('agency_id')->default(0);
			$table->boolean('completed_nysc')->nullable()->default(0);
			$table->string('nysc_year', 4)->nullable();
			$table->string('country', 50)->nullable();
			$table->string('personal_info_viewer', 50)->nullable()->default('followers');
			$table->string('graduation_grade', 59)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cvs');
	}

}
