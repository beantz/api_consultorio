<?php

namespace App\Interfaces;

interface PacientesRepositoriesInterface
{
    public function getAllUsers();

    public function create($request);
}
