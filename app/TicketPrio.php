<?php

namespace App;

enum TicketPrio: string
{
    //
    case LOW = "low";
    case MEDIUM = "medium";
    case HIGH = "";

    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Low',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
        };
    }
}
