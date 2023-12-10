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
        Schema::create('appetizer', function (Blueprint $table) {
            $table->id();
            $table->string('marca');
            $table->string('tipo');
            $table->bigInteger('quantidade');
            $table->datetime('data_entrada_produto'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appetizer');
    }
};
