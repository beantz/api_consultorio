<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Procedimento extends Model
{
    use SoftDeletes;
    
    protected $table = 'procedimento'; 

    protected $fillable = ['nome', 'orientacoes' ,'medicamento_pre', 'medicamento_pos'];

    public function agendamento() {
        return $this->belongsToMany('App\Models\Agendamento', 'agendamento_procedimento');
    }
}