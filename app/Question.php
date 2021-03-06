<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // protected $fillable = ['segmento_id', 'question', 'photo', 'comments', 'approved'];

	protected $table = 'PreguntasAuditoria';

    protected $primaryKey = 'IdPreguntaSegmentoAuditoria';

    public $timestamps = false;

    public function resultados()
    {
        return $this->hasMany(ResultadoAuditoria::class, 'IdPregunta');
    }

    public function segmentos()
    {
    	return $this->belongsTo(Auditoria::class, 'IdSegmentoAuditoria');
    }
}
