<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Payloads\Calendars\NewAttendee;
use App\Http\Payloads\Calendars\NewCalendar;
use App\Http\Payloads\Calendars\NewEvent;
use App\Models\Attendee;
use App\Models\Calendar;
use App\Models\Event;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Throwable;

final readonly class CalendarService
{
    public function __construct(
        private DatabaseManager $database,
    ) {
    }

    /**
     * @param NewCalendar $payload
     * @return Calendar|Model
     * @throws Throwable
     */
    public function create(NewCalendar $payload): Calendar|Model
    {
        return $this->database->transaction(
            callback: fn () => Calendar::query()->create(
                attributes: $payload->toArray(),
            ),
            attempts: 3,
        );
    }

    /**
     * @param NewEvent $payload
     * @return Event|Model
     * @throws Throwable
     */
    public function addEvent(NewEvent $payload): Event|Model
    {
        return $this->database->transaction(
            callback: fn () => Event::query()->create(
                attributes: $payload->toArray(),
            ),
            attempts: 3,
        );
    }

    /**
     * @param NewAttendee $payload
     * @return Attendee|Model
     * @throws Throwable
     */
    public function inviteAttendee(NewAttendee $payload): Attendee|Model
    {
        return $this->database->transaction(
            callback: fn () => Attendee::query()->create(
                attributes: $payload->toArray(),
            ),
            attempts: 3,
        );
    }
}
