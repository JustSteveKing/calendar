<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Http\Resources\EventResource;
use App\Models\Event;
use Ijpatricio\Mingle\Concerns\InteractsWithMingles;
use Ijpatricio\Mingle\Contracts\HasMingles;
use Illuminate\Http\Resources\Json\JsonResource;
use Livewire\Component;

final class CalendarApp extends Component implements HasMingles
{
    use InteractsWithMingles;

    public string $view = 'dayGridMonth';

    public function component(): string
    {
        return 'resources/js/CalendarApp/index.js';
    }

    /**
     * @param Event $event
     * @return JsonResource
     */
    public function fetchDetails(Event $event): JsonResource
    {
        $event->load(['attendees.user','calendar','organizer']);

        return new EventResource(
            resource: $event,
        );
    }

    /** @return array<string,mixed> */
    public function mingleData(): array
    {
        return [
            'events' => Event::query()->get()->map(fn (Event $event) => [
                'id' => $event->id,
                'title' => $event->summary,
                'date' => $event->starts_at
            ]),
            'view' => $this->view,
        ];
    }

    public function toggle(): void
    {
        $this->view = 'listWeek';
    }

    public function dump(): void
    {
        dd('test');
    }

    public function doubleIt(int $amount): int
    {
        return $amount * 2;
    }
}
