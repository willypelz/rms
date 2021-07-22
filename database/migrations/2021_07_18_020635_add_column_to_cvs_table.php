<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToCvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cvs', function (Blueprint $table) {
            $table->string('hrms_staff_id')->nullable();
            $table->string('hrms_grade')->nullable();
            $table->string('hrms_dept')->nullable();
            $table->string('hrms_location')->nullable();
            $table->string('hrms_length_of_stay')->nullable();
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
            $table->dropColumn(['hrms_staff_id','hrms_grade','hrms_dept','hrms_location','hrms_length_of_stay']);
        });
    }
}
