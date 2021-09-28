<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCheckboxToInterviewNoteOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_note_options', function (Blueprint $table) {
            $table->string('check_box')->nullable();
            $table->string('dropdown')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interview_note_options', function (Blueprint $table) {
            $table->dropColumn('check_box');
            $table->dropColumn('dropdown');
        });
    }
}
