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
            $table->unsignedInteger('questionary_id');
            $table->unsignedInteger('sucursal_id')
            $table->string('name');
            $table->string('photo')->nullable();
            $table->bigInteger('value');
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
