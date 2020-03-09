<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultadoAuditoria extends Model
{
    protected $table = 'ResultadoAuditoria';

    protected $primaryKey = 'Id';

    protected $dates = ['FechaRegistro'];

    public function auditorias()
    {
        return $this->belongsTo(Auditoria::class, 'IdAuditoria');
    }

    public function segmentos()
    {
    	return $this->belongsTo(Segmento::class, 'IdSegmentoAuditoria');
    }

    public function questions()
    {
        return $this->belongsTo(Question::class, 'IdPregunta');
    }
}
