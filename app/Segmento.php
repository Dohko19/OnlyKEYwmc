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
        return $this->belongsToMany(Auditoria::class, 'ResultadoAuditoria');
    }

    public function questions()
    {
    	return $this->belongsToMany(Question::class, 'ResultadoAuditoria');
    }

	public function sucursals()
	{
		return $this->belongsTo(Sucursal::class, 'sucursal_id');
	}

    public function scopeAllowed($query)
    {
        if (auth()->user()->can('view', $this))
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
