<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agendamento extends Model
{
    use SoftDeletes;

    protected $table = 'agendamento';

    protected $fillable = ['data_consulta', 'relatorio_consulta', 'user_patients_id'];

    public function procedimento() {
        return $this->belongsToMany('App\Models\Procedimento', 'agendamento_procedimento');
    }

    public function users() : BelongsTo {
        return $this->belongsTo('App\Models\User', 'user_patients_id');
    }
}