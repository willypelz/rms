<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MakeModifiedLastModifiedAndActionDateUpdateCurrentTimestampOnEdit extends Migration
{

    private $tables = [
        'associations',
        'ats_products',
        'ats_providers',
        'ats_requests',
        'ats_services',
        'awards',
        'certifications',
        'company_transactions',
        'cv_id',
        'cv_prices',
        'cvs',
        'educations',
        'experiences',
        'interview',
        'job_application_messages',
        'job_applications',
        'job_users',
        'links',
        'specializations',
    ];

    private $possibleColumns = [
        'last_modified',
        'modified',
        'action_at',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table) {
            // where table has column
            foreach ($this->possibleColumns as $column) { // loop through defined columns
                if (Schema::hasColumn($table, $column)) {

                    DB::statement('ALTER TABLE '
                        . $table
                        . ' CHANGE '
                        . $column
                        . ' '
                        . $column
                        . ' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');

                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public
    function down()
    {
        foreach ($this->tables as $table) {
            // where table has column
            foreach ($this->possibleColumns as $column) { // loop through defined columns
                if (Schema::hasColumn($table, $column)) {

                    DB::statement('ALTER TABLE '
                        . $table
                        . ' CHANGE '
                        . $column
                        . ' '
                        . $column
                        . ' TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');

                }
            }
        }
    }
}
