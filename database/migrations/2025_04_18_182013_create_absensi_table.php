<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('absensi', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->date('tanggal');
        $table->time('waktu_masuk');
        $table->time('waktu_keluar')->nullable();
        $table->string('lokasi_masuk');
        $table->string('lokasi_keluar')->nullable();
        $table->timestamps(); // created_at dan updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
