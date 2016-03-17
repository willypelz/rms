<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('company_id')->unsigned()->index();
            $table->dateTime('order_date');
            $table->double('total_amount');
            $table->string('discount');
                $table->timestamps();


            $table->foreign('company_id')
              ->references('id')->on('companies')
              ->onDelete('cascade');
            
        });


        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('order_id')->unsigned()->index();
            $table->integer('itemId');
            $table->string('type');
            $table->string('name');
            $table->double('price');
                $table->timestamps();


            $table->foreign('order_id')
              ->references('id')->on('orders')
              ->onDelete('cascade');
            
        });

         Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('order_id')->unsigned()->index();
            $table->string('status');
            $table->string('message');
                $table->timestamps();


            $table->foreign('order_id')
              ->references('id')->on('orders')
              ->onDelete('cascade');
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('orders');
        Schema::drop('order_items');
        Schema::drop('transactions');

    }
}
