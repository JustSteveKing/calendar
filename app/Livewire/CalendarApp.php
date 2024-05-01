<?php

declare(strict_types=1);

namespace App\Livewire;

use Ijpatricio\Mingle\Concerns\InteractsWithMingles;
use Ijpatricio\Mingle\Contracts\HasMingles;
use Livewire\Component;

final class CalendarApp extends Component implements HasMingles
{
    use InteractsWithMingles;

    public function component(): string
    {
        return 'resources/js/CalendarApp/index.js';
    }

    /** @return array<string,string> */
    public function mingleData(): array
    {
        return [
            'message' => 'Message in a bottle 🍾',
        ];
    }

    public function doubleIt(int $amount): int
    {
        return $amount * 2;
    }
}
