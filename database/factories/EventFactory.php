<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Booking\Category;
use App\Enums\Booking\Status;
use App\Models\Calendar;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class EventFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Event::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'summary' => $this->faker->sentence(),
            'timezone' => $this->faker->timezone(),
            'status' => $this->faker->randomElement(Status::cases()),
            'category' => $this->faker->randomElement(Category::cases()),
            'description' => $this->faker->realText(),
            'location' => null,
            'repeat_rule' => null,
            'calendar_id' => Calendar::factory(),
            'user_id' => User::factory(),
            'starts_at' => $start = $this->faker->dateTimeBetween('now', '+1 years'),
            'ends_at' => $end = $this->faker->dateTimeBetween($start, '+1 years'),
        ];
    }
}
