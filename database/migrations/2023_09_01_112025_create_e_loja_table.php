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
        Schema::create('loja', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 80)->nullable();
            $table->string('bairro', 80)->nullable();
            $table->string('rua', 80)->nullable();
            $table->string('num_casa', 10)->nullable();
            $table->string('numero', 45)->nullable();
            $table->string('cnpj', 45)->nullable();
            $table->string('foto', 225)->nullable();

            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loja');
    }
};
