<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('prod_id');
            $table->string('qty');
            $table->string('price');
            $table->timestamps();
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
