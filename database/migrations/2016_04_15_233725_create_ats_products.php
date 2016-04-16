<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtsProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('ats_providers', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('name');
        //     $table->text('address');
        //     $table->string('phone');
        //     $table->string('email');
        //     $table->string('logo');
        //     $table->string('website');
        //     $table->string('username');
        //     $table->string('password');
        //     $table->boolean('active');
            
        //     $table->softDeletes();
        //     $table->timestamps();
        // });

        // Schema::create('ats_products', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('ats_provider_id')->unsigned()->index();
        //     $table->string('name');
        //     $table->text('summary');
        //     $table->text('details');
        //     $table->float('cost');
        //     $table->float('discount');
        //     $table->integer('order');
        //     $table->boolean('active');
            
        //     $table->softDeletes();
        //     $table->timestamps();

        //     $table->foreign('ats_provider_id')
        //       ->references('id')->on('ats_providers')
        //       ->onDelete('cascade');
        // });


        // Schema::create('ats_requests', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('ats_product_id')->unsigned()->index();
        //     $table->integer('job_application_id')->unsigned()->index();
        //     $table->float('cost');
        //     $table->float('discount');
        //     $table->string('status');
        //     $table->text('notes');
        //     $table->text('final_report');
        //     $table->text('attachments');
            
        //     $table->softDeletes();
        //     $table->timestamps();

        //     $table->foreign('ats_products')
        //       ->references('id')->on('ats_products')
        //       ->onDelete('cascade');

        //     $table->foreign('job_application_id')
        //       ->references('id')->on('job_applications')
        //       ->onDelete('cascade');
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop('ats_requests');
        // Schema::drop('ats_products');
        // Schema::drop('ats_providers');
    }
}
