<?php

namespace App;

enum Users: string
{
    case ADMIN = 'admin';
    case SECRETÁRIA = 'secretaria';
    case PACIENTE = 'paciente';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
