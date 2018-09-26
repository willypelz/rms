<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoiceItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('invoice_id')->nullable();
			$table->timestamps();
			$table->string('type', 24)->nullable();
			$table->integer('type_id')->nullable();
			$table->text('image', 65535)->nullable();
			$table->text('title', 65535)->nullable();
			$table->decimal('amount', 10, 0)->nullable();
			$table->integer('count')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('invoice_items');
	}

}
