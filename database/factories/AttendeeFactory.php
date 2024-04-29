<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Booking\Status;
use App\Models\Attendee;
use App\Models\Calendar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class AttendeeFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Attendee::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(Status::cases()),
            'calendar_id' => Calendar::factory(),
            'user_id' => User::factory(),
        ];
    }
}
