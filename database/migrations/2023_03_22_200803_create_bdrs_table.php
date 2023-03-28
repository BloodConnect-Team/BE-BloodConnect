<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBdrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bdrs', function (Blueprint $table) {
            $table->bigIncrements('id_bdrs');
            $table->string('bdrs_nama');
            $table->string('bdrs_kontak');
            $table->string('bdrs_alamat');
            $table->string('bdrs_lat');
            $table->string('bdrs_lng');
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
        Schema::dropIfExists('rs');
    }
}
