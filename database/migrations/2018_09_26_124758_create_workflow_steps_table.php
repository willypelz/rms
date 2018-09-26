<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workflow_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('workflow_id')->unsigned();
            $table->string('name');
            $table->integer('rank')->default(0);
            $table->boolean('requires_approval')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->boolean('show_to_applicant')->default(false);
            $table->longText('message_template')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('workflow_steps');
    }
}
