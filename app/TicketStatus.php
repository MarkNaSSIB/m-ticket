<?php

namespace App;

enum TicketStatus: string
{
    //
    case OPEN = 'open';
    case INPROGRESS = 'in_progress';
    case RESOLVED = 'resolved';

    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Open',
            self::INPROGRESS => 'In Progress',
            self::RESOLVED => 'Resolved',
        };
    }

}
