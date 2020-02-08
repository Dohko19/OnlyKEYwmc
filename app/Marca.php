<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = [
    	'grupo_marca_id', 'name', 'description', 'photo',
    ];

    // public static function create(array $attributes = [])
    // {
    //     $attributes['user_id'] = auth()->id();

    //     $marca = static::query()->create($attributes);

    //     return $marca;
    // }

    // public function users()
    // {
    // 	return $this->belongsTo(User::class);
    // }
    public function grupos()
    {
        return $this->belongsTo(GrupoMarca::class, 'grupo_marca_id');
    }

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class);
    }

    public function questionnaires()
    {
        return $this->hasMany(Questionnaire::class);
    }
    //query scopes
    public function scopeAllowed($query)
    {
        if (auth()->user()->can('view', $this))
        {
            return $query; //Verficacion de si es administrador
        }
            return $query->where('grupo_marca_id', auth()->id());
    }

    public function scopeExiste($query)
    {
        return $query->where('grupo_marca_id', auth()->id());
    }

    public function scopeGraphics($query, $graphics)
    {
        if($graphics)
            return $query->where('created_at', 'LIkE', "%$graphics%");
    }
}
