<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCandidateIdToCvs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cvs', function (Blueprint $table) {
            $table->integer('candidate_id')->unsigned()->nullable()->index();
            $table->foreign('candidate_id')->references('id')->on('candidates')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cvs', function (Blueprint $table) {
            $table->dropForeign(['candidate_id']);
            // $table->dropIndex(['candidate_id']);
            $table->dropColumn('candidate_id');
        });
    }
}
