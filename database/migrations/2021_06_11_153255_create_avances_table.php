<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avances', function (Blueprint $table) {
                $table->id();
                $table->integer('avance_ala_fecha_pocentaje');
                //$table->string('fecha');
                $table->text('obs_avance')->nullable();
                //$table->integer('id_meta')->default(0);
                $table->unsignedBigInteger('id_meta');
                $table->unsignedBigInteger('id_usuario_reg');

                $table->foreign('id_meta')
                ->references('id')->on('metas');
                
                $table->foreign('id_usuario_reg')
                ->references('id')->on('users');
                
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
        Schema::dropIfExists('avances');
    }
}
