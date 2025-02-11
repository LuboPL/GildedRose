<?php
declare(strict_types=1);

namespace App\Enum;

enum ItemType: string
{
    case CHEESE = 'cheese';
    case TICKET = 'ticket';
    case LEGENDARY = 'legendary';
    case ELIXIR = 'elixir';
    case ELECTRONIC = 'electronic';
}
