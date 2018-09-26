<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company_transactions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('company_id');
			$table->integer('user_id')->nullable();
			$table->string('type', 50)->default('');
			$table->string('transaction_id', 100)->nullable();
			$table->dateTime('transaction_date');
			$table->float('amount', 10, 0)->nullable();
			$table->string('status', 25)->nullable();
			$table->text('details', 65535)->nullable();
			$table->string('payment_method', 25)->nullable();
			$table->dateTime('payment_date')->nullable();
			$table->text('payment_comment', 65535)->nullable();
			$table->dateTime('modified')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('company_transactions');
	}

}
