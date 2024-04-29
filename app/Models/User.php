<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $timezone
 * @property null|string $remember_token
 * @property null|CarbonInterface $email_verified_at
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property null|CarbonInterface $deleted_at
 * @property Collection<Group> $groups
 * @property Collection<GroupMember> $memberships
 * @property Collection<Calendar> $calendars
 * @property Collection<Event> $events
 * @property Collection<Attendee> $attending
 */
final class User extends Authenticatable
{
    use HasFactory;
    use HasUuids;
    use Notifiable;
    use SoftDeletes;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'email',
        'password',
        'timezone',
        'remember_token',
        'email_verified_at',
    ];

    /** @var array<int,string> */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @return HasMany */
    public function groups(): HasMany
    {
        return $this->hasMany(
            related: Group::class,
            foreignKey: 'user_id',
        );
    }

    /** @return HasMany */
    public function memberships(): HasMany
    {
        return $this->hasMany(
            related: GroupMember::class,
            foreignKey: 'user_id',
        );
    }

    /** @return MorphMany */
    public function calendars(): MorphMany
    {
        return $this->morphMany(
            related: Calendar::class,
            name: 'linkable',
        );
    }

    /** @return HasMany */
    public function events(): HasMany
    {
        return $this->hasMany(
            related: Event::class,
            foreignKey: 'user_id',
        );
    }

    /** @return HasMany */
    public function attending(): HasMany
    {
        return $this->hasMany(
            related: Attendee::class,
            foreignKey: 'user_id',
        );
    }

    /** @return array<string,string> */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
