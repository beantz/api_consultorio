<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendamentoProcedimento extends Model {
    
    protected $table = 'agendamento_procedimento';
    
    protected $fillable = ['procedimento_id', 'agendamento_id'];
}