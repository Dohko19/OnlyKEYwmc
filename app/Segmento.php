<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
	// protected $fillable = ['comments', 'puntuacion', 'sucursal_id', 'approved'];

    protected $table = 'SegmentosAuditoria';

    protected $primaryKey = 'IdSegmentoAuditoria';

    public $timestamps = false;

    public function auditorias()
    {
        return $this->belongsTo(Auditoria::class, 'IdAuditoria');
    }

    public function questions()
    {
    	return $this->hasMany(Question::class, 'IdSegmento');
    }

	// public function sucursals()
	// {
	// 	return $this->belongsTo(Sucursal::class, 'sucursal_id');
	// }

    public function resultados()
    {
        return $this->hasMany(ResultadoAuditoria::class, 'IdSegmento');
    }

    public function scopeAllowed($query)
    {
        if (auth()->user()->hasRole('Admin'))
        {
            return $query; //Verficacion de si es administrador
        }
            return $query->where('user_id', auth()->id());
    }

    public function scopeExiste($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function scopeSegmento($query, $segmento)
    {
        if($segmento)
            return $query->where('segmento', 'LIkE', "%".Carbon::parse($segmento)->format('Y-m')."%");
    }

}
