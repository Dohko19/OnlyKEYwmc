<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntasCuestionario extends Model
{
	/* * Solo para tomar el listado de las preguntas del cuestionario y mostrarlas debajo de la
	   * grafica*/
    protected $table = 'PreguntasCuestionario';

    protected $primaryKey = 'IdPregunta';

    public $timestamps = false;

}
