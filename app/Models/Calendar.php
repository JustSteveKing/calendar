<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Booking\Visibility;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $id
 * @property string $name
 * @property Visibility $visibility
 * @property null|string $color
 * @property string $linkable_id
 * @property string $linkable_type
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Model $linkable
 * @property Collection<Event> $events
 * @property Collection<Attendee> $attendees
 */
final class Calendar extends Model
{
    use HasFactory;
    use HasUuids;

    /** @var array<int,string> */
    protected $fillable = [
        'name',
        'visibility',
        'color',
        'linkable_id',
        'linkable_type',
    ];

    /** @return MorphTo */
    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }

    /** @return HasMany */
    public function events(): HasMany
    {
        return $this->hasMany(
            related: Event::class,
            foreignKey: 'calendar_id',
        );
    }

    /** @return HasMany */
    public function attendees(): HasMany
    {
        return $this->hasMany(
            related: Attendee::class,
            foreignKey: 'calendar_id',
        );
    }

    /** @return array<string,class-string> */
    protected function casts(): array
    {
        return [
            'visibility' => Visibility::class,
        ];
    }
}
