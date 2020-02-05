<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['segmento_id', 'question', 'photo', 'comments', 'approved'];

    public function answers()
    {
    	return $this->belongstoMany(Answer::class);
    }

    public function segmentos()
    {
    	return $this->belongsTo(Segmento::class);
    }
}
