<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
	protected $table = 'questionnaires';
    public function sucursals()
    {
    	return $this->belongsTo(Sucursal::class, 'id');
    }
}
