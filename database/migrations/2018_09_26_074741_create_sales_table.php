<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->double('paid_price');
            $table->string('sale_invoice');
            $table->double('total_discount')->default(0);
            $table->double('total_expense')->default(0);
            $table->double('net_total_price');
            $table->string('issueDate');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
