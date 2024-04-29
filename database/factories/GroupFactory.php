<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class GroupFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Group::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->realText(),
            'icon' => null,
            'user_id' => User::factory(),
        ];
    }
}
