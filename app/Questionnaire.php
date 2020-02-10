<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $fillable = [
    	'marca_id','name','photo','value','recommendation',
    ];

    public function cuestionario()
    {
    	return $this->belongsTo(Questionary::class, 'questionary_id');
    }
}
