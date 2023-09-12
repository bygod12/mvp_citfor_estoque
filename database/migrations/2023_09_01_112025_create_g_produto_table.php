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
        Schema::create('produto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doador_id')->nullable();;
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('loja_id');


            $table->foreign('loja_id')->references('id')->on('loja');


            $table->foreign('doador_id')->references('id')->on('doador');
            $table->foreign('categoria_id')->references('id')->on('categoria');

            $table->string('nome', 45);
            $table->text('descricao')->nullable();
            $table->decimal('valor', 10);
            $table->integer('qtd');
            $table->string('foto', 2048)->nullable();
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
        Schema::dropIfExists('produto');
    }
};
