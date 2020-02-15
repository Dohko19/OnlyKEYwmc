<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dm extends Model
{
    public function sucursales()
    {
    	return belongsTo(Sucursal::class, 'sucursal_id');
    }
}
