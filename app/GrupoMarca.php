<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoMarca extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'logo'];

    public function users()
    {
    	return $this->belongsTo(User::class);
    }

    public function marcas()
    {
    	return $this->hasMany(Marca::class);
    }
}
