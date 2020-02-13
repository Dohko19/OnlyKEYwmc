<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
	protected $fillable = [
		'name', 'marca_id', 'ciudad', 'IdCte', 'delegacion_municipio'
	];

    public function marcas()
    {
    	return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function segmentos()
    {
    	return $this->hasMany(Segmento::class);
    }

    public function qresults()
    {
        return $this->hasMany(Qresults::class);
    }

    public function questionaries()
    {
        return $this->hasMany(Questionnaire::class);
    }


    public function scopeGraphics($query, $graphics)
    {
        if($graphics)
            return $query->where('created_at', 'LIkE', "%$graphics%");
    }

    public function scopeDm($query, $dm)
    {
        if($dm)
            return $query->where('delegacion_municipio', 'LIkE', "%$dm%");
    }

    public function scopeAllowed($query)
    {
        if (auth()->user()->can('view', $this))
        {
            return $query; //Verficacion de si es administrador
        }
            return $query->where('marca_id', $this->marcas->grupos->id);
    }
}
