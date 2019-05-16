<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoleIdsToJobTeamInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_team_invites', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
            $table->text('role_ids')->after('job_id');
            $table->string('role_name');
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
            $table->integer('role_id')->unsigned()->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->dropColumn('role_ids');
            $table->dropColumn('role_name');
        });
    }
}
