<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = ['data_consulta', 'relatorio_consulta', 'paciente_id'];
}
