<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('desa', function (Blueprint $table) {
            $table->bigIncrements('desa_id');
            $table->string('nama_desa');
            $table->string('kecamatan');
            $table->string('kabupaten_kota');
            $table->string('provinsi');
            $table->integer('jumlah_penduduk');
            $table->timestamps();
        });

        Schema::create('program_desa', function (Blueprint $table) {
            $table->bigIncrements('program_id');
            $table->string('nama_program');
            $table->text('deskripsi_program');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->unsignedBigInteger('desa_id');
            $table->foreign('desa_id')->references('desa_id')->on('desa')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('pelaksana_program', function (Blueprint $table) {
            $table->bigIncrements('pelaksana_id');
            $table->string('nama_pelaksana');
            $table->string('jabatan');
            $table->string('kontak');
            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('program_id')->on('program_desa')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    	Schema::dropIfExists('pelaksana_program');
        Schema::dropIfExists('program_desa');
        Schema::dropIfExists('desa');
    }
};
