<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNamaAndDepartemenToPenilaiansTable extends Migration
{
    protected $connection = 'mongodb';
    public function up()
    {
        Schema::table('penilaians', function (Blueprint $table) {
            $table->string('nama');
            $table->string('departemen');
        });
    }

    public function down()
    {
        Schema::table('penilaians', function (Blueprint $table) {
            $table->dropColumn(['nama', 'departemen']);
        });
    }
}
