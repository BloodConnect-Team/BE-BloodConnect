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
            $table->bigInteger('bdrs_id');
            $table->bigInteger('user_id');
            $table->string('requests_slug');
            $table->string('requests_pasien');
            $table->enum('requests_goldar', ['A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-']);
            $table->string('requests_jenis');
            $table->integer('requests_jumlah');
            $table->string('requests_hp');
            $table->string('requests_nama');
            $table->timestamp('requests_waktu')->useCurrent();
            $table->text('requests_catatan')->nullable();
            $table->enum('requests_status', [0, 1, 2])->default(0);
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
