<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspeccionSanitariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspeccion_sanitarias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('sucursal_id');
            $table->string('instalacion_areas');
            $table->string('equipo_utensilios');
            $table->string('servicio');
            $table->string('almacenamiento');
            $table->string('control de operacion');
            $table->string('materias_primas');
            $table->string('envases');
            $table->string('agua_alimentos');
            $table->string('mantenimiento_limpieza');
            $table->string('manejo_residuos');
            $table->string('salud_higiene_personal');
            $table->string('transporte');
            $table->string('documentos y capacitacion');
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
        Schema::dropIfExists('inspeccion_sanitarias');
    }
}
