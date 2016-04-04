<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCompanyCvJoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('company_folders_cvs', function (Blueprint $table) {
            //
             $table->renameColumn('company_id', 'company_folder_id');
             $table->dropColumn('date_added');

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
        Schema::table('company_folders_cvs', function (Blueprint $table) {
            //
             $table->rename('company_folder_id', 'company_id');
             // $table->dropColumn('date_added');

             // $table->timestamps();
        });
    }
}
