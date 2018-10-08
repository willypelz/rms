<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_application_id')->unsigned()->nullable()->index();
            $table->foreign('job_application_id')->references('id')->on('job_applications')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->text('message');
            $table->text('attachment');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages');
    }
}
