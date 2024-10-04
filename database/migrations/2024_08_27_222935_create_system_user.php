<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       DB::table('users')->insert([
            'id' => 1,
            'name' => 'System',
            'email' => 'system@example.com',
            'password' => Hash::make('password'),
]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->delete([
            'id' => 1
        ]);
    }
};
