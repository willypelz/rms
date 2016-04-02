<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUploadedByToCvs extends Migration
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
             $table->integer('uploaded_by')->nullable()->unsigned()->index()->after('uploaded_date');
             $table->text('tagline')->nullable()->after('summary');
             $table->string('display_picture')->default('default-profile.png')->after('tagline');
             $table->string('highest_qualification')->nullable()->after('display_picture');
            $table->string('last_position')->nullable()->after('highest_qualification');
            $table->string('last_company_worked')->nullable()->after('last_position');
            $table->integer('years_of_experience')->nullable()->after('last_company_worked');


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
             $table->dropColumn('uploaded_by');
             $table->dropColumn('tagline');
             $table->dropColumn('display_picture');
             $table->dropColumn('highest_qualification');
             $table->dropColumn('last_position');
             $table->dropColumn('last_company_worked');
             $table->dropColumn('years_of_experience');

        });
    }
}
