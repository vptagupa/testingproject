<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasTable('user_mig_test')) {
            Schema::create('user_mig_test', function(Blueprint $table) {
                $table->increments('id');
                $table->string('user_id');
                $table->string('password');
                $table->string('fillname');
            });
        }
        

        // Schema::table('user_mig_test', function(Blueprint $table) {
        //     $table->string('user_id',50)->change();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
