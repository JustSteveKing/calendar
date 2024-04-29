<?php

declare(strict_types=1);

namespace App\Http\Payloads\Calendars;

use App\Enums\Booking\Visibility;
use Illuminate\Database\Eloquent\Model;

final readonly class NewCalendar
{
    public function __construct(
        public string $name,
        public Visibility $visibility,
        public null|string $color,
        public Model $linkable,
    ) {
    }

    /**
     * @return array{
     *     name:string,
     *     visibility:Visibility,
     *     color:null|string,
     *     linkable_id:string,
     *     linkable_type:class-string,
     * }
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'visibility' => $this->visibility,
            'color' => $this->color,
            'linkable_id' => $this->linkable->getKey(),
            'linkable_type' => $this->linkable->getMorphClass(),
        ];
    }
}
