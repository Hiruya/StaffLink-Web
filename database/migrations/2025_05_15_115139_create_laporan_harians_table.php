<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanHariansTable extends Migration
{
    public function up()
    {
        Schema::create('laporan_harians', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->date('tanggal');
            $table->string('nama');
            $table->string('departemen');
            $table->string('shift');
            $table->time('jam_kerja');
            $table->time('jam_keluar');
            $table->json('pelayanan')->nullable();
            $table->json('dokumentasi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_harians');
    }
}