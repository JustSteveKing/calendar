<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Identity\Role;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class GroupMemberFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = GroupMember::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'role' => $this->faker->randomElement(Role::cases()),
            'group_id' => Group::factory(),
            'user_id' => User::factory(),
        ];
    }
}
