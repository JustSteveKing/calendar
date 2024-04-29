<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Booking\Visibility;
use App\Models\Calendar;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class CalendarFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Calendar::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'visibility' => $this->faker->randomElement(Visibility::cases()),
            'color' => $this->faker->hexColor(),
            'linkable_id' => Group::factory(),
            'linkable_type' => Group::class,
        ];
    }
}
