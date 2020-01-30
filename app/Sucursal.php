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
    	return $this->belongsTo(Marca::class);
    }

    public function inspeccions()
    {
    	return $this->hasMany(InspeccionSanitaria::class);
    }
}
