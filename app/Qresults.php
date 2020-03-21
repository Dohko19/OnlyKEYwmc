<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qresults extends Model
{
    public function sucursals()
    {
    	return $this->belongsTo(Sucursal::class);
    }
}
