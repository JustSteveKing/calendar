<?php

declare(strict_types=1);

namespace App\Enums\Booking;

enum Status: string
{
    case Invited = 'invited';
    case Confirmed = 'confirmed';
    case Tentative = 'tentative';
    case Cancelled = 'cancelled';
}
