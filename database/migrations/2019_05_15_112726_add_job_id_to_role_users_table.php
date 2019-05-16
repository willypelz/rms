<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobIdToRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_user', function (Blueprint $table) {
            $table->integer('job_id')->nullable();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('CASCADE')->onUpdate('CASCADE');
            try{
                $table->dropPrimary('user_id_primary');
                $table->dropPrimary('role_id_primary');
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::info($e);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_user', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign(['job_id']);
            $table->dropColumn('job_id');
            Schema::enableForeignKeyConstraints();

        });
    }
}
