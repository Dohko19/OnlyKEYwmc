<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionary extends Model
{
    protected $fillable = [
    	'user_id', 'sucursals_id', 'comments', 'riesgo', 'total'
    ];

    public function sucursales()
    {
    	return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function users()
    {
    	return $this->belongsTo(User::class);
    }
    public function questions()
    {
    	return $this->hasMany(Questionnaire::class);
    }
}
