<?php

namespace App\Interfaces;

interface ProcedimentosRepositoriesInterface
{
    
    public function getAllProcedures();

    public function createProcedures($request);

    public function findProcedure($id);
}
