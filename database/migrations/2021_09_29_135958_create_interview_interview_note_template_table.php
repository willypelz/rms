<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewInterviewNoteTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_interview_note_template', function (Blueprint $table) {
            $table->integer('interview_id');
            $table->foreign('interview_id')->references('id')->on('interview')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->integer('interview_note_template_id')->unsigned();
            $table->foreign('interview_note_template_id','int_temp_foreign')->references('id')->on('interview_note_templates')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('interview_interview_note_template');
    }
}
