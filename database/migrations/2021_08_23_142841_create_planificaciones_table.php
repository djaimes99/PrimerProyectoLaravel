<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planificaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_meta');
            $table->string('fecha_inicio');
            $table->string('fecha_fin');
            $table->string('fecha_realCulm')->nullable();
            $table->integer('asignado');
            $table->text('observacion')->nullable();

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
        Schema::dropIfExists('planificaciones');
    }
}
