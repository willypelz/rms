<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_application_id');
            $table->integer('test_id');
            $table->string('test_name')->nullable();
            $table->string('test_owner')->nullable();
            $table->datetime('start_time');
            $table->integer('order_id');
            $table->datetime('end_time');
            $table->text('location')->nullable();
            $table->datetime('actual_start_time')->nullable();
            $table->datetime('actual_end_time')->nullable();
            $table->float('score')->nullable();
            $table->text('result_comment')->nullable();
            $table->string('status')->default('PENDING');
            $table->integer('credit');


            $table->timestamps();

        });

        Schema::table('ats_requests', function ($table) {
            $table->integer('order_id');
            
        });

        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('test_requests');
        Schema::drop('ats_requests');

    }
}

