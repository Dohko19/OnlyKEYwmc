<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $fillable = [
    	'marca_id','name','photo','value','recommendation',
    ];

    public function sucursales()
    {
    	return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }
}
