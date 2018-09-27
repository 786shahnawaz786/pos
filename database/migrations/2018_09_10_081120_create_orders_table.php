<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id');
            $table->string('status')->default('pending');
            $table->string('tax')->nullable();
            $table->text('InvoiceNo');
            $table->double('otherExpense')->default(0);
            $table->string('issueDate');
            $table->string('receiveDate');
            $table->string('from_loc')->nullable();
            $table->string('to_loc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
