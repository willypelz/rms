<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobApplicatnToJobActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_activities', function (Blueprint $table) {
            //
            // Schema::rename($from, $to);
                $table->renameColumn('cv_id', 'job_application_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_activities', function (Blueprint $table) {
            //
                $table->renameColumn('cv_id', 'job_application_id');
            
        });
    }
}
