<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsInternalBooleanToJobTeamInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('job_team_invites', function (Blueprint $table) {
            $table->boolean('is_internal')->after('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('job_team_invites', function (Blueprint $table) {
            $table->dropColumn('is_internal');
        });
    }
}
