<?php

declare(strict_types=1);

/**
 * @property CalendarService $service
 */

use App\Enums\Booking\Category;
use App\Enums\Booking\Status;
use App\Enums\Booking\Visibility;
use App\Http\Payloads\Calendars\NewAttendee;
use App\Http\Payloads\Calendars\NewCalendar;
use App\Http\Payloads\Calendars\NewEvent;
use App\Models\Attendee;
use App\Models\Calendar;
use App\Models\Event;
use App\Models\User;
use App\Services\CalendarService;

beforeEach(function (): void {
    $this->service = app(CalendarService::class);
});

test('a calendar can be created', function (): void {
    $user = User::factory()->create();

    expect(
        Calendar::query()->count(),
    )->toEqual(0)->and(
        $this->service->create(new NewCalendar(
            name: 'test',
            visibility: Visibility::Public,
            color: null,
            linkable: $user,
        )),
    )->toBeInstanceOf(Calendar::class)->and(
        Calendar::query()->count(),
    )->toEqual(1);
});

test('a calendar can add an event', function (): void {
    $calendar = Calendar::factory()->create();

    expect(
        Event::query()->count()
    )->toEqual(0)->and(
        $this->service->addEvent(new NewEvent(
            summary: 'test',
            timezone: 'UTC',
            status: Status::Invited,
            category: Category::Personal,
            description: 'test',
            location: null,
            repeat: null,
            calendar: $calendar->id,
            user: User::factory()->create()->id,
            starts: now(),
            ends: now()->addHour(),
        )),
    )->toBeInstanceOf(Event::class)->and(
        Event::query()->count(),
    )->toEqual(1);
});

test('an attendee can be invited', function (): void {
    $event = Event::factory()->create();

    expect(
        Attendee::query()->count()
    )->toEqual(0)->and(
        $this->service->inviteAttendee(new NewAttendee(
            status: Status::Invited,
            event: $event->id,
            user: User::factory()->create()->id,
        )),
    )->toBeInstanceOf(Attendee::class)->and(
        Attendee::query()->count(),
    )->toEqual(1);
});
