<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserFolderContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_folder_contents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('item_type', 11)->nullable();
			$table->text('item_id', 65535)->nullable();
			$table->integer('folder_id')->nullable();
			$table->dateTime('date_added')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_folder_contents');
	}

}
