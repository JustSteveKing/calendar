<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Booking\Visibility;
use App\Models\Calendar;
use App\Models\Event;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Steve McDougall',
            'email' => 'juststevemcd@gmail.com',
        ]);

        $group = Group::factory()->for($user)->create([
            'name' => 'Livestreaming',
        ]);

        $calendar = Calendar::factory()->for($user, 'linkable')->create([
            'visibility' => Visibility::Internal,
        ]);

        Event::factory()->for($calendar)->for($user, 'organizer')->create();
    }
}
