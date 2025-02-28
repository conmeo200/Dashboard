<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('bo_menu', 'type')) { 
            Schema::table('bo_menu', function (Blueprint $table) {
                $table->enum('type', ['public', 'primary'])->default('public')->after('keyword');
            });
        }    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('bo_menu', 'type')) {
            Schema::table('bo_menu', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
}
