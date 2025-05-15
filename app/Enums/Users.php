<?php

namespace App\Enums;

enum Users: string
{
    case ADMIN = 'admin';
    case SECRETÁRIA = 'secretaria';
    case PACIENTE = 'paciente';

    //retornar um array com o nome dos cases e o value desses cases
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
