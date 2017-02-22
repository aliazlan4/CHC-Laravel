<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIconGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iconGroups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Schema::table('users', function(Blueprint $table) {
        //     $table->foreign('iconGroup')->references('id')->on('iconGroups');
        // });
        // Schema::table('icons', function(Blueprint $table) {
        //     $table->foreign('iconGroup')->references('id')->on('iconGroups');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iconGroups');
    }
}
