<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metas', function (Blueprint $table) {
            $table->id();
            $table->text('meta');
            $table->text('iniciativa')->nullable();
            $table->text('supuesto')->nullable();
            $table->string('indicadores')->nullable();
            $table->string('fecha_inicio');
            $table->string('fecha_fin');
            $table->string('fecha_culminada_meta')->nullable();
            $table->integer('nro_programado_demanda')->nullable();
            $table->integer('nro_programado_demanda_porasignar')->nullable();
            $table->integer('ejecutado')->nullable();
            $table->integer('avance_ala_fecha')->nullable()->default(0);
            $table->text('obs_avance_obstaculo')->nullable();
            $table->text('observacion_just_imprevisto_meta')->nullable();
            $table->text('explicacion_prog_dem')->nullable();
            $table->string('nro_pto_cta_aprob_poai')->nullable();
            $table->unsignedBigInteger('estatus')->nullable()->default(1);
            $table->unsignedBigInteger('id_coordinacion');
            $table->unsignedBigInteger('meta_modo')->default(1);;
            $table->unsignedBigInteger('id_usuario_reg')->nullable();
            $table->unsignedBigInteger('id_objetivo');
            $table->unsignedBigInteger('tipo');

            $table->foreign('estatus')
            ->references('id')->on('estatus');

            $table->foreign('id_coordinacion')
            ->references('id')->on('coordinaciones');
            
            $table->foreign('id_usuario_reg')
            ->references('id')->on('users');

            $table->foreign('id_objetivo')
            ->references('id')->on('objetivos');

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
        Schema::dropIfExists('metas');
    }
}
