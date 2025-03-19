<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomerCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            if (!Schema::connection('mongodb')) return false;

            Schema::connection('mongodb')->create('customers', function ($collection) {
                $collection->index('id_user');
                $collection->index('active');
                $collection->timestamps();
            });
        } catch (\Exception $exception) {
            Log::error("Error create customer collection : {$exception->getMessage()}");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mongodb')->dropIfExists('customers');
    }
}
