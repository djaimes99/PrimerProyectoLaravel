<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjetivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetivos', function (Blueprint $table) {
            $table->id();
            $table->text('objetivo');
            $table->integer('avance_obj')->nullable()->default(0);
            $table->unsignedBigInteger('id_usuario_reg')->nullable();
            $table->unsignedBigInteger('tipo')->nullable()->default(0);
            $table->unsignedBigInteger('id_coordinacion')->nullable();
            $table->unsignedBigInteger('estatus')->nullable()->default(1);
            $table->string('fecha_culminada_obj')->nullable();
            $table->text('observacion_just_imprevisto_obj');
            $table->timestamps();
            
            $table->foreign('id_usuario_reg')
            ->references('id')->on('users');

            $table->foreign('id_coordinacion')
            ->references('id')->on('coordinaciones');

            $table->foreign('estatus')
            ->references('id')->on('estatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objetivos');
    }
}
