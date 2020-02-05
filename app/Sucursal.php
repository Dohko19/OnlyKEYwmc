<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
	protected $fillable = [
		'name', 'marca_id', 'ciudad'
	];

    public function marcas()
    {
    	return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function segmentos()
    {
    	return $this->hasMany(Segmento::class);
    }
}
