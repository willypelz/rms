<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStepIdsToJobTeamInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_team_invites', function (Blueprint $table) {
            $table->text('step_ids')->after('role_ids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_team_invites', function (Blueprint $table) {
            $table->dropColumn('step_ids');
        });
    }
}
