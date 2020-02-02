<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFluxoCaixasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fluxo_caixas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->string('action');
            $table->float('cash')->default(0);
            $table->float('credit')->default(0);
            $table->float('debit')->default(0);
            $table->float('balance');
            $table->bigInteger('caixa_id')->unsigned();
            $table->foreign('caixa_id')->references('id')->on('caixas')->onDelete('cascade');
            $table->dateTime('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fluxo_caixas');
    }
}
