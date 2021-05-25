<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBenefitAndRemunerationToJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
	        $table->string('benefits')->nullable();
	        $table->string('minimum_remuneration')->nullable();
	        $table->string('maximum_remuneration')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
	        $table->dropColumn('benefits');
	        $table->dropColumn('minimum_remuneration');
	        $table->dropColumn('maximum_remuneration');
        });
    }
}
