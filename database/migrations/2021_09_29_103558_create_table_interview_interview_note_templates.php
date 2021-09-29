<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInterviewInterviewNoteTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_interview_interview_note_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('interview_id')->unsigned()->index();
            $table->foreign('interview_id')->references('id')->on('interviews')->onDelete('cascade');

            $table->integer('interview_note_template_id')->unsigned()->index();
            $table->foreign('interview_note_template_id')->references('id')->on('interview_note_templates')->onDelete('cascade');

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
        Schema::dropIfExists('table_interview_interview_note_templates');
    }
}
