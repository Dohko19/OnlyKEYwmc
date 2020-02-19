<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table = 'Auditorias';

    protected $primaryKey = 'IdAuditoria';

    public $timestamps = false;

    public function segmentos()
    {
    	return $this->belongsToMany(Segmento::class, 'ResultadoAuditoria');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'ResultadoAuditoria');
    }
}
