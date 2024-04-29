<?php

declare(strict_types=1);

use App\Enums\Identity\Role;
use App\Http\Payloads\Groups\NewGroup;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\User;
use App\Services\GroupService;

/**
 * @property GroupService $service
 */
beforeEach(function () {
    $this->service = app(GroupService::class);
});

test('a group can be created', function (): void {
    $user = User::factory()->create();

    expect(
        Group::query()->count(),
    )->toEqual(0)->and(
        $this->service->create(new NewGroup(
            name: 'test',
            description: 'test',
            icon: null,
            user: $user->id,
        ))
    )->and(
        Group::query()->count(),
    )->toEqual(1);
});

test('a member can be added to a group', function (): void {
    $group = Group::factory()->create();

    expect(
        GroupMember::query()->count(),
    )->toEqual(1);

    $this->service->addMember(
        group: $group->id,
        user: User::factory()->create()->id,
        role: Role::Member,
    );

    expect(
        GroupMember::query()->count(),
    )->toEqual(2);
});

test('a group can be updated', function (): void {
    $group = Group::factory()->create();

    expect(
        $group->name
    )->not->toBeNull()->and(
        $this->service->update($group->id, new NewGroup(
            name: 'test',
            description: $group->description,
            icon: null,
            user: $group->user->id,
        )),
    )->toBeBool()->toEqual(true)->and(
        $group->refresh()->name,
    )->toEqual('test');
});
