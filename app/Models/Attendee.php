<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Booking\Status;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property Status $status
 * @property string $event_id
 * @property string $user_id
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property Event $event
 * @property User $user
 */
final class Attendee extends Model
{
    use HasFactory;
    use HasUuids;

    /** @var array<int,string> */
    protected $fillable = [
        'status',
        'event_id',
        'user_id',
    ];

    /** @return BelongsTo */
    public function event(): BelongsTo
    {
        return $this->belongsTo(
            related: Event::class,
            foreignKey: 'event_id',
        );
    }

    /** @return BelongsTo */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /** @return array<string,class-string> */
    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }
}
