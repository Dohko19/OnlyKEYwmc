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
    	return $this->hasMany(Segmento::class, 'IdSegmentoAuditoria');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'auditoria_user', 'auditoria_id', 'user_id');
    }
}
