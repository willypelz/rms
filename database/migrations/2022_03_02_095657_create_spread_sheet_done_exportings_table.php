<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpreadSheetDoneExportingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spread_sheet_done_exportings', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id');
            $table->unsignedInteger('admin_id');
            $table->foreign('admin_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('data');
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('spread_sheet_done_exportings');
    }
}
