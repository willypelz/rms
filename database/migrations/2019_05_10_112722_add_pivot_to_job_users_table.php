<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPivotToJobUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_users', function (Blueprint $table) {
            $table->boolean('can_view')->default(0);
            $table->boolean('can_edit')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_users', function (Blueprint $table) {
            $table->dropColumn(['can_edit', 'can_view']);
        });
    }
}
