<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stoks', function (Blueprint $table) {
            $table->id();
            $table->integer('a_pos');
            $table->integer('b_pos');
            $table->integer('ab_pos');
            $table->integer('o_pos');
            $table->integer('a_neg');
            $table->integer('b_neg');
            $table->integer('ab_neg');
            $table->integer('o_neg');
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
        Schema::dropIfExists('stoks');
    }
}
