<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreOptionsToCvSource extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cvs', function (Blueprint $table) {
            $table->dropColumn('cv_source');
            // $table->string('cv_source')->default('Direct Application')->after('extracted_content');
            
        });

        Schema::table('cvs', function (Blueprint $table) {
            // $table->dropColumn('cv_source');
            $table->string('cv_source')->default('Direct Application')->after('extracted_content');
            
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
            //
        });
    }
}
