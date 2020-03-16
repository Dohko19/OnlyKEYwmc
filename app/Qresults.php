<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qresults extends Model
{
    public function sucursales()
    {
    	return $this->belongsTo(Sucursal::class);
    }
}
