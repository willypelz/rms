<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('log_name');
            $table->string('description');
            $table->integer('action_id')->nullable()->unsigned()->index();
            $table->string('action_type')->nullable();
            $table->integer('causee_id')->nullable()->unsigned()->index();
            $table->integer('causer_id')->nullable()->unsigned()->index();
            $table->string('causer_type')->nullable();
            $table->text('properties')->nullable();
            $table->boolean('is_active')->default(1)->index();
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
        Schema::dropIfExists('activity_logs');
    }
}
