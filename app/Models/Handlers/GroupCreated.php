<?php

declare(strict_types=1);

namespace App\Models\Handlers;

use App\Jobs\GroupWasCreated;
use App\Models\Group;

use function dispatch;

final class GroupCreated
{
    public function __construct(Group $group)
    {
        dispatch(job: new GroupWasCreated(
            group: $group->id,
            user: $group->user_id,
        ));
    }
}
