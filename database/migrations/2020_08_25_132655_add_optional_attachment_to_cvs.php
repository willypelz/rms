<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOptionalAttachmentToCvs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cvs', function (Blueprint $table) {
            $table->text('optional_attachment_1')->nullable()->after('cv_file');
            $table->text('optional_attachment_2')->nullable()->after('optional_attachment_1');
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
            $table->dropColumn('optional_attachment_1');
            $table->dropColumn('optional_attachment_2');
        });
    }
}
