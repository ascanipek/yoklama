<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRollcallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rollcalls', function (Blueprint $table) {
            $table->id();
            $table->integer('number',11);
            $table->integer('state',11);
            $table->string('class')->default('');
            $table->string('branch')->default('');
            $table->integer('teacher',11);
            $table->integer('schedule',11);
            $table->integer('lesson',11); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rollcalls');
    }
}
