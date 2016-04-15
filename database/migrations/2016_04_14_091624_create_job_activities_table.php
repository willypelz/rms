<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->integer('cv_id')->unsigned()->index()->nullable();
            $table->integer('job_id')->unsigned()->index()->nullable();
            $table->text('comment')->nullable();
            $table->string('activity_type');
            $table->timestamps();

            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');

            //    $table->foreign('cv_id')
            //   ->references('id')->on('cvs')
            //   ->onDelete('cascade');

            // $table->foreign('job_id')
            //   ->references('id')->on('jobs')
            //   ->onDelete('cascade');

             

        });

        Schema::table('jobs', function ($table) {
            $table->dropColumn('job_category_id');
            $table->dropColumn('job_url');
            $table->dropColumn('address');
            $table->dropColumn('post_date');
            $table->dropColumn('expiry_date');
            $table->dropColumn('skill');
            $table->dropColumn('hiring_progress_id');
            $table->dropColumn('company');
            $table->dropColumn('published');
            $table->dropColumn('status');
            $table->dropColumn('approved');
            $table->dropColumn('verified');

            $table->string('status');
            $table->date('post_date');
            $table->date('expir_date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('job_activities');
    }
}
