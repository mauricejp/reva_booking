<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('venue_id');
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
            // Añade más columnas según sea necesario
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fields');
    }
}
