<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsCancelledToJobTeamInvites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_team_invites', function (Blueprint $table) {
            $table->boolean('is_cancelled')->default(false)->after('is_declined');
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
            $table->dropColumn('is_cancelled');
        });
    }
}
