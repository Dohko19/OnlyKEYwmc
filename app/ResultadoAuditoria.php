<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadoAuditoria extends Model
{
     protected $table = 'ResultadoAuditoria';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    public function auditorias()
    {
        return $this->belongsTo(Auditoria::class, 'IdAuditoria');
    }

    public function segmentos()
    {
    	return $this->belongsTo(Segmento::class, 'IdSegmento');
    }

    public function questions()
    {
        return $this->belongsTo(Question::class, 'IdPregunta');
    }
}
