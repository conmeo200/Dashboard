<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');                        
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');     
            $table->string('product_name');
            $table->float('product_price');
            $table->integer('quantity');
            $table->float('total');
            $table->enum('status', ['Proccess', 'Pending', 'Success'])->default('Proccess');
            $table->integer('created_time');
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
