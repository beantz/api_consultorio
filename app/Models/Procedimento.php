<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedimento extends Model
{
    protected $fillable = ['nome', 'orientacoes' ,'medicamento_pre', 'medicamento_pos'];
}
