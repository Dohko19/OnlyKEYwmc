<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
	protected $fillable = ['comments', 'puntuacion', 'sucursal_id', 'approved'];

	public function sucursals()
	{
		return $this->belongsTo(Sucursal::class, 'sucursal_id');
	}

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function questions()
    {
    	return $this->hasMany(Question::class);
    }

    public function scopeAllowed($query)
    {
        if (auth()->user()->can('view', $this))
        {
            return $query; //Verficacion de si es administrador
        }
            return $query->where('user_id', auth()->id());
    }

}
