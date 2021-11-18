<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesglosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desgloses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_meta');
            $table->string('desde');
            $table->string('hasta');
            $table->integer('asignado');
            $table->text('observacion_desg')->nullable();

            $table->foreign('id_meta')
            ->references('id')->on('metas');
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
        Schema::dropIfExists('desgloses');
    }
}
