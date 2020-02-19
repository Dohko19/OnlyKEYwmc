<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoMarca extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'logo', 'tipo'];

    public function users()
    {
    	return $this->belongsTo(User::class);
    }

    public function marcas()
    {
    	return $this->hasMany(Marca::class);
    }

    public function scopeAllowed($query)
    {
        if (auth()->user()->can('view', $this))
        {
            return $query; //Verficacion de si es administrador
        }
            return $query->where('user_id', auth()->user()->id);
    }
}
