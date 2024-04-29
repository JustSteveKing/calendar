<?php

declare(strict_types=1);

namespace App\Http\Payloads\Calendars;

use App\Enums\Booking\Status;

final readonly class NewAttendee
{
    public function __construct(
        public Status $status,
        public string $event,
        public string $user,
    ) {
    }

    /**
     * @return array{
     *     status:Status,
     *     event_id:string,
     *     user_id:string,
     * }
     */
    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'event_id' => $this->event,
            'user_id' => $this->user,
        ];
    }
}
