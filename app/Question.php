<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function answers()
    {
    	return $this->belongstoMany(Answer::class);
    }

    public function sucursals()
    {
    	return $this->belongsTo(Sucursal::class);
    }
}
