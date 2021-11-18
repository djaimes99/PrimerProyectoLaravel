<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_actividad');
            $table->unsignedBigInteger('estatus')->nullable()->default(1);
            $table->unsignedBigInteger('id_usuario_reg')->nullable();
            $table->unsignedBigInteger('id_meta');
            $table->unsignedBigInteger('tipo');
            $table->string('fecha_estim_final')->nullable();
            $table->string('fecha_culminada_act')->nullable();
            $table->text('observacion_just_imprevisto_act');

            $table->foreign('estatus')
            ->references('id')->on('estatus');

            $table->foreign('id_usuario_reg')
            ->references('id')->on('users');

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
        Schema::dropIfExists('actividades');
    }
}
