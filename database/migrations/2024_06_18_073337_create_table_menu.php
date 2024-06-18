<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bo_menu', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->string('name');
            $table->string('keyword');
            $table->string('icon');
            $table->integer('order');
            $table->enum('active', ['Y', 'N'])->default('Y');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bo_menu');
    }
}
