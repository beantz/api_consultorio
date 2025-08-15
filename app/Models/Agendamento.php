<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $table = 'agendamento';

    protected $fillable = ['data_consulta', 'relatorio_consulta', 'user_patients_id'];
}
