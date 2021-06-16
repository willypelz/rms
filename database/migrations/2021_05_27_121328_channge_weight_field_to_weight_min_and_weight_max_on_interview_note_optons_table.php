<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChanngeWeightFieldToWeightMinAndWeightMaxOnInterviewNoteOptonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interview_note_options', function (Blueprint $table) {
            $table->integer('weight_min')->nullable();
            $table->integer('weight_max')->nullable();
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
            $table->dropColumn('weight_min');
            $table->dropColumn('weight_max');
        });
    }
}
