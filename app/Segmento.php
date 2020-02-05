<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
	protected $fillable = ['comments'];

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


}
