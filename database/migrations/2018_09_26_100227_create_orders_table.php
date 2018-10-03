<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('company_id')->unsigned()->index();
			$table->dateTime('order_date');
			$table->string('type', 200)->nullable();
			$table->float('total_amount', 10, 0);
			$table->string('discount')->nullable()->default('');
			$table->timestamps();
			$table->string('trans_id');
			$table->string('invoice_no');
			$table->string('customer_id');
			$table->string('customer_card');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
