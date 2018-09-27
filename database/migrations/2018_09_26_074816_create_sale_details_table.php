<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('sale_details', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('sale_id');
            $table->integer('item_id');
            $table->double('qty'); 
            $table->double('price'); 
            $table->double('qty_discount')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sale_details');
    }
}
