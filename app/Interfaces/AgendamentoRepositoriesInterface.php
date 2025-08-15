<?php

namespace App\Interfaces;

interface AgendamentoRepositoriesInterface {
    
    public function getAll();
    public function create($request);
    
}
