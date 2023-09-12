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
        Schema::create('movimentacao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');

            $table->foreign('produto_id')->references('id')->on('produto');

            $table->string('data_movimentacao', 45);
            $table->integer('qtd_movimentada');
            $table->string('tipo_movimentacao', 45);
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
        Schema::dropIfExists('movimentacao');
    }
};
