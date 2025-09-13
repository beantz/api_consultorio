<?php

namespace App\Interfaces;

interface OrcamentoRepositoriesInterface
{
    public function getAll();

    public function create($request);

    public function find($id_orcamento);
}
