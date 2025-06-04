<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PacientesRepositoriesFacades extends Facade {

    /* metodo responsavel por retornar o nome do indice da classe que deve ser retornado a instancia, ao executar o service container */
    protected static function getFacadeAccessor() {
        return 'paciente.repository';
    }

}