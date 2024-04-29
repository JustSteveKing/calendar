<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Enums\Identity\Role;
use App\Models\GroupMember;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class GroupWasCreated implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly string $group,
        public readonly string $user,
    ) {
    }

    public function handle(DatabaseManager $database): void
    {
        $database->transaction(
            callback: fn () => GroupMember::query()->create([
                'role' => Role::Admin,
                'group_id' => $this->group,
                'user_id' => $this->user,
            ]),
            attempts: 3,
        );
    }
}
