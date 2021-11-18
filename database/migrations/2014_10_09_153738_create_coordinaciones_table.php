<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordinacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_coord');
            $table->unsignedBigInteger('id_usuario_enc_coord')->nullable()->default(0);;
            $table->unsignedBigInteger('id_gerencia')->nullable()->default(0);

            $table->foreign('id_gerencia')
            ->references('id')->on('gerencias');
            
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
        Schema::dropIfExists('coordinaciones');
    }
}
