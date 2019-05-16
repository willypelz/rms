<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToInterviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview', function (Blueprint $table) {
            $table->string('interview_file')->nullable();
            $table->float('duration')->nullable();
            $table->boolean('reschedule')->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interview', function (Blueprint $table) {
            $table->dropColumn('interview_file');
            $table->dropColumn('duration');
            $table->dropColumn('reschedule');
        });
    }
}
