<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromSuc extends Model
{
    protected $fillable = ['sucursal_id', 'average', 'fecharegistro'];

    public function sucursales()
    {
    	return $this->belongsTo(Sucursal::class);
    }
}
