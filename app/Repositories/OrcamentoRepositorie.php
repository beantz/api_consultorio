<?php

namespace App\Repositories;

use App\Interfaces\OrcamentoRepositoriesInterface;
use App\Models\Orcamento;
use App\Models\User;

class OrcamentoRepositorie {

    public function getAll() {

        $orcamentos = Orcamento::all();
        return $orcamentos;

    }

    public function create($request) {

        $orcamento = Orcamento::create($request->all())->makeHidden('updated_at', 'created_at');
        return $orcamento;

    }

    public function find($id_orcamento) {

        $orcamento = Orcamento::find($id_orcamento)->makeHidden('updated_at', 'created_at');
        return $orcamento;

    }

}