<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = [
    	'user_id', 'name', 'description', 'photo',
    ];

    public static function create(array $attributes = [])
    {
        $attributes['user_id'] = auth()->id();

        $marca = static::query()->create($attributes);

        return $marca;
    }

    public function users()
    {
    	return $this->belongsTo(User::class);
    }

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class);
    }

    public function scopeAllowed($query)
    {
        if (auth()->user()->can('view', $this))
        {
            return $query; //Verficacion de si es administrador o puede ver sus propias marcas
        }
            return $query->where('user_id', auth()->id());
    }
}
