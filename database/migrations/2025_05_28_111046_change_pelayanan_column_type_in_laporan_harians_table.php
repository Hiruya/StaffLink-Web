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
    Schema::table('laporan_harians', function (Blueprint $table) {
        $table->text('pelayanan')->nullable()->change();
    });
}

public function down()
{
    Schema::table('laporan_harians', function (Blueprint $table) {
        $table->json('pelayanan')->nullable()->change();
    });
}
};
