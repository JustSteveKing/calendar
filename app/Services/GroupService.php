<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Identity\Role;
use App\Http\Payloads\Groups\NewGroup;
use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Throwable;

final readonly class GroupService
{
    public function __construct(
        private AuthManager $auth,
        private DatabaseManager $database,
    ) {
    }

    /**
     * @param NewGroup $payload
     * @return Group|Model
     * @throws Throwable
     */
    public function create(NewGroup $payload): Group|Model
    {
        return $this->database->transaction(
            callback: fn () => Group::query()->create(
                attributes: $payload->toArray(),
            ),
            attempts: 3,
        );
    }

    /**
     * @param string $group
     * @param NewGroup $payload
     * @return bool
     * @throws Throwable
     */
    public function update(string $group, NewGroup $payload): bool
    {
        return (bool) $this->database->transaction(
            callback: fn () => Group::query()->where('id', $group)->update(
                values: $payload->toArray(),
            ),
            attempts: 3,
        );
    }

    /**
     * @param string $group
     * @param string $user
     * @param Role $role
     * @return GroupMember|Model
     * @throws Throwable
     */
    public function addMember(string $group, string $user, Role $role): GroupMember|Model
    {
        return $this->database->transaction(
            callback: fn () => GroupMember::query()->create(
                attributes: [
                    'role' => $role,
                    'group_id' => $group,
                    'user_id' => $user,
                ],
            ),
            attempts: 3,
        );
    }
}
