<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendamentoProcedimento extends Model
{
    protected $fillable = ['id_procedimento', 'id_agendamento'];
}
