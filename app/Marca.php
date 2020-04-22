<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = [
    	'grupo_marca_id', 'user_id' ,'name', 'description', 'photo',
    ];

    protected $with = ['average'];


    public function grupos()
    {
        return $this->belongsTo(GrupoMarca::class, 'grupo_marca_id');
    }

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class);
    }

    //query scopes
    public function scopeAllowed($query)
    {
        if (auth()->user()->can('view', $this))
        {
            return $query; //Verficacion de si es administrador
        }
            return $query->where('user_id', auth()->id());
    }

    public function scopeExiste($query)
    {
        return $query->where('grupo_marca_id', $this);
    }

    public function scopeGraphics($query, $graphics)
    {
        if($graphics)
            return $query->where('created_at', 'LIkE', "%$graphics%");
    }

    public function average()
    {
        return $this->hasOne(Marcaprom::class);
    }

}
