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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description');
            $table->timestamps();
        });

        // Insertar roles por defecto
        DB::table('roles')->insert([
            ['name' => 'Player', 'description' => 'Regular user who can book fields'],
            ['name' => 'Venue Administrator', 'description' => 'User who manages venues and fields'],
            ['name' => 'System Administrator', 'description' => 'Superuser with access to all features'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};

