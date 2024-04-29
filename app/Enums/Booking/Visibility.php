<?php

declare(strict_types=1);

namespace App\Enums\Booking;

enum Visibility: string
{
    case Public = 'public';
    case Internal = 'internal';
    case Private = 'private';
}
