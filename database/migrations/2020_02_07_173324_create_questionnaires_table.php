<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('questionary_id')->nullable();
            $table->unsignedInteger('sucursal_id')->nullable();
            $table->string('name')->nullable();
            $table->binary('Evidencia')->nullable();
            $table->bigInteger('Value');
            $table->Integer('IdCuestionario');
            $table->Integer('IdUsuario');
            $table->Integer('Division');
            $table->Integer('IdCedula');
            $table->text('recommendation');
            $table->string('riesgo')->nullable();
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
        Schema::dropIfExists('questionnaires');
    }
}
