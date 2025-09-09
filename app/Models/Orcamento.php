<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    protected $fillable = ['relatorio', 'valor_total', 'id_agendamento'];
}
