<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Handlers\GroupCreated;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property string $id
 * @property string $name
 * @property null|string $description
 * @property null|string $icon
 * @property string $user_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property User $user
 * @property Collection<GroupMember> $members
 * @property Collection<Calendar> $calendars
 */
final class Group extends Model
{
    use HasFactory;
    use HasUuids;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'description',
        'icon',
        'user_id',
    ];

    /** @var array<string,class-string> */
    protected $dispatchesEvents = [
        'created' => GroupCreated::class,
    ];

    /** @return BelongsTo */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /** @return HasMany */
    public function members(): HasMany
    {
        return $this->hasMany(
            related: GroupMember::class,
            foreignKey: 'group_id',
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
}
