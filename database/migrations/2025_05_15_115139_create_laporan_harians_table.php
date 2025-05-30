<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanHariansTable extends Migration
{
    protected $connection = 'mongodb';
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
            $table->string('pelayanan')->nullable();
            $table->json('dokumentasi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_harians');
    }
}
