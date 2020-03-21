<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
	protected $fillable = [
		'name', 'marca_id', 'ciudad', 'IdCte', 'delegacion_municipio', 'phone', 'zone', 'region', 'cedula'
	];


    public function marcas()
    {
    	return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function segmentos()
    {
    	return $this->hasMany(Segmento::class, 'IdSegmentoAuditoria');
    }

    public function audres()
    {
        return $this->hasMany(Aresult::class, 'sucursal_id');
    }
    //
    public function qresults()
    {
        return $this->hasMany(Qresults::class, 'sucursal_id');
    }

    public function quest()
    {
        return $this->hasMany(Questionnaire::class, 'sucursal_id');
    }
    //

    public function dm()
    {
        return $this->hasOne(Dm::class, 'dm_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function promsuc()
    {
        return $this->hasMany(PromSuc::class, 'sucursal_id');
    }

    public function rauditoria()
    {
        return $this->hasMany(ResultadoAuditoria::class, 'sucursal_id');
    }
}
