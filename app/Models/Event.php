<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Booking\Category;
use App\Enums\Booking\Status;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $summary
 * @property string $timezone
 * @property Status $status
 * @property Category $category
 * @property null|string $description
 * @property null|object $location
 * @property null|object $repeat_rule
 * @property string $calendar_id
 * @property string $user_id
 * @property CarbonInterface $starts_at
 * @property null|CarbonInterface $ends_at
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Calendar $calendar
 * @property User $organizer
 */
final class Event extends Model
{
    use HasFactory;
    use HasUuids;

    /** @var array<int,string> */
    protected $fillable = [
        'summary',
        'timezone',
        'status',
        'category',
        'description',
        'location',
        'repeat_rule',
        'calendar_id',
        'user_id',
        'starts_at',
        'ends_at',
    ];

    /** @return BelongsTo */
    public function calendar(): BelongsTo
    {
        return $this->belongsTo(
            related: Calendar::class,
            foreignKey: 'calendar_id',
        );
    }

    /** @return BelongsTo */
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /** @return array<string,string|class-string> */
    protected function casts(): array
    {
        return [
            'status' => Status::class,
            'category' => Category::class,
            'location' => 'json',
            'repeat_rule' => 'json',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }
}
