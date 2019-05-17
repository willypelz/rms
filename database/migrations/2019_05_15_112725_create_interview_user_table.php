<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
//        Schema::create('interview_user', function (Blueprint $table) {
//          $table->integer('user_id')->unsigned();
//          $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
//          $table->integer('interview_id');
//          $table->foreign('interview_id')->references('id')->on('interview')->onUpdate('CASCADE')->onDelete('CASCADE');
//          $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::disableForeignKeyConstraints();
      Schema::dropIfExists('interview_user');
    }
}
