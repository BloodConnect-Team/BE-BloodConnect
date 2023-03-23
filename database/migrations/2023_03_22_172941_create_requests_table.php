<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id_requests');
            $table->bigInteger('rs_id');
            $table->bigInteger('user_id');
            $table->string('requests_pasien');
            $table->string('requests_goldar');
            $table->string('requests_jenis');
            $table->integer('requests_jumlah');
            $table->string('requests_hp');
            $table->timestamp('requests_waktu')->nullable();
            $table->text('requests_catatan')->nullable();
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
        Schema::dropIfExists('requests');
    }
}
