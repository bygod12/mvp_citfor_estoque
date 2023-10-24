<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doador', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loja_id');
            $table->foreign('loja_id')->references('id')->on('loja');
            $table->date('hora_entrega');
            $table->string('nomedoador', 80);
            $table->string('email', 80)->nullable();;

            $table->string('bairro', 80)->nullable();;
            $table->string('rua', 80)->nullable();;
            $table->string('num_casa', 10)->nullable();;
            $table->string('numero_1', 45)->nullable();
            $table->string('numero_2', 45)->nullable();
            $table->boolean('entregue');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doador');
    }
};
