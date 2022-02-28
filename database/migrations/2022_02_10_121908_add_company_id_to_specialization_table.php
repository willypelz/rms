<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdToSpecializationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'specializations', function (Blueprint $table) {
                $table->foreignId('company_id')->nullable()->constrained();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'specializations', function (Blueprint $table) {
                $table->dropForeign(['company_id']);
            }
        );
        if (Schema::hasColumn('specializations', 'company_id')) {
            Schema::table(
                'specializations',
                function (Blueprint $table) {
                    $table->dropColumn('company_id');
                }
            );
        }
    }
}
