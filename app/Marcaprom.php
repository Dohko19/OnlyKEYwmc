<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marcaprom extends Model
{
    protected $fillable = ['marca_id', 'promedio'];


    public function marcas()
    {
    	return $this->belongsTo(Marca::class);
    }
}
