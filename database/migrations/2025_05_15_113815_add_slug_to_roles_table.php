<?php

use Illuminate\Database\Migrations\Migration;
use MongoDB\Laravel\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    protected $connection = 'mongodb';
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('slug')->unique();
        });

        // Isi slug untuk data yang sudah ada
        \App\Models\Role::all()->each(function($role) {
            $role->slug = Str::slug($role->name);
            $role->save();
        });
    }

    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
