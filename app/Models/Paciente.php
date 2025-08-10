<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = ['nome', 'idade', 'contato', 'alergias', 'medicamentos_usados'];
}
