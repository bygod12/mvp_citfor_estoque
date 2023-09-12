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
        Schema::create('item_venda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('venda_id');
            $table->foreign('produto_id')->references('id')->on('produto');
            $table->foreign('venda_id')->references('id')->on('venda');
            $table->integer('qtd_vendida');
            $table->decimal('preco_unitario', 10);
            $table->decimal('sub_total', 10);
            $table->string('condigo_produto');

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
        Schema::dropIfExists('item_venda');
    }
};
