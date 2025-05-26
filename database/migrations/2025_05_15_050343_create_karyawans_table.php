<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'mongodb';
    public function up(): void
    {
        Schema::connection('mongodb')->create('karyawans', function ($collection) {
            $collection->index('employee_id');
            $collection->unique('user_id');
            $collection->string('name')->nullable();
            $collection->string('department')->nullable();
            $collection->string('region')->nullable();
            $collection->string('education')->nullable();
            $collection->string('gender')->nullable();
            $collection->string('recruitment_channel')->nullable();
            $collection->integer('no_of_trainings')->nullable();
            $collection->integer('age')->nullable();
        });

    }

    public function down(): void
    {
        Schema::connection('mongodb')->dropIfExists('karyawans');
    }
};
