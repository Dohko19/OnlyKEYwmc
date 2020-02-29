<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aresult extends Model
{
    protected $fillable = ['sucursal_id', 'IdCedula', 'IdSegmentoAuditoria', 'Promedio'];

    public function sucursals()
    {
    	return $this->belongsTo(Sucursal::class);
    }

    public function segmentos()
    {
    	return $this->belongsTo(Segmento::class, 'IdSegmentoAuditoria');
    }
}
