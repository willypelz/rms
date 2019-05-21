<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class AddJobIdToRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data =  DB::table('role_user')->get();

        Schema::drop('role_user');
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->nullable()->unsigned();

            $table->integer('role_id')->nullable()->unsigned();

            $table->integer('job_id')->nullable()->unsigned();

        });

        foreach ($data as $row){
           $row = (array)$row;
            DB::table('role_user')->insert($row);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
