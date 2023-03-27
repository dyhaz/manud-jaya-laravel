<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestPerizinanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_perizinan', function (Blueprint $table) {
            $table->bigIncrements('request_id');
            $table->date('tanggal_request');
            $table->string('status_request');
            $table->text('keterangan');
            $table->text('lampiran')->nullable();
            $table->unsignedBigInteger('jenis_id');
            $table->unsignedBigInteger('warga_id');
            $table->foreign('jenis_id')->references('jenis_id')->on('jenis_perizinan')->onDelete('cascade');
            $table->foreign('warga_id')->references('warga_id')->on('warga')->onDelete('cascade');
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
        Schema::dropIfExists('request_perizinan');
    }
}
