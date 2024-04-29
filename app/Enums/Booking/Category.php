<?php

declare(strict_types=1);

namespace App\Enums\Booking;

enum Category: string
{
    case Business = 'business';
    case Personal = 'personal';
    case Education = 'education';
    case Health = 'health';
    case Vacation = 'vacation';
}
