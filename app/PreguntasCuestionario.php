<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntasCuestionario extends Model
{
    protected $table = 'PreguntasCuestionario';

    protected $primaryKey = 'IdPregunta';

    public $timestamps = false;
}
