<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mongodb';
    /**
     * Jalankan migrasi: menambahkan kolom `department`.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('department')->nullable(); // Menambahkan kolom department
        });
    }

    /**
     * Reverse the migrations: menghapus kolom `department`.
     */
    public function down(): void
    {
        Schema::dropIfExists('department');
    }
};
