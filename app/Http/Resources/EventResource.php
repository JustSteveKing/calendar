<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Event $resource
 */
final class EventResource extends JsonResource
{
    /**
     * @return array<string,mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->summary,
            'description' => $this->resource->description,
            'status' => $this->resource->status,
            'organizer' => $this->resource->organizer->name,
        ];
    }
}
