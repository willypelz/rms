<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCvFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cvs', function (Blueprint $table) {
            //
            $table->string('state_of_origin')->nullable()->after('religion');  
            $table->boolean('willing_to_relocate')->nullable()->after('state_of_origin');    


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
            $table->dropColumn('state_of_origin');
            $table->dropColumn('willing_to_relocate');


        });
    }
}
