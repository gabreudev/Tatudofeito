<?php

namespace App\Enums;

enum ServicoEnum: string
{
    case CULINARIA = 'culinaria';
    case REPAROS = 'reparos';
    case PINTURA = 'pintura';
    case LIMPEZA = 'limpeza';
    case MUDANCA = 'mudanca';
    case PISCINA = 'piscina';
    case OUTROS = 'outros';

    public function label(): string
    {
        return match($this) {
            self::CULINARIA => 'culinaria',
            self::REPAROS => 'reparos',
            self::PINTURA => 'pintura',
            self::LIMPEZA => 'limpeza',
            self::MUDANCA => 'mudança',
            self::PISCINA => 'piscina',
            self::OUTROS => 'outros',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
