<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgendamentoProcedimento extends Model {

    use SoftDeletes;
    
    protected $table = 'agendamento_procedimento';
    
    protected $fillable = ['procedimento_id', 'agendamento_id'];

}