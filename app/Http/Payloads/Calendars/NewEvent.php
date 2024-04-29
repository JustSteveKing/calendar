<?php

declare(strict_types=1);

namespace App\Http\Payloads\Calendars;

use App\Enums\Booking\Category;
use App\Enums\Booking\Status;
use Carbon\CarbonInterface;

final readonly class NewEvent
{
    public function __construct(
        public string $summary,
        public string $timezone,
        public Status $status,
        public Category $category,
        public null|string $description,
        public null|string $location,
        public null|string $repeat,
        public string $calendar,
        public string $user,
        public CarbonInterface $starts,
        public null|CarbonInterface $ends,
    ) {
    }

    /**
     * @return array{
     *     summary:string,
     *     timezone:string,
     *     status:Status,
     *     category:Category,
     *     description:null|string,
     *     location:null|string,
     *     repeat_rule:null|string,
     *     calendar_id:string,
     *     user_id:string,
     *     starts_at:CarbonInterface,
     *     ends_at:null|CarbonInterface,
     * }
     */
    public function toArray(): array
    {
        return [
            'summary' => $this->summary,
            'timezone' => $this->timezone,
            'status' => $this->status,
            'category' => $this->category,
            'description' => $this->description,
            'location' => $this->location,
            'repeat_rule' => $this->repeat,
            'calendar_id' => $this->calendar,
            'user_id' => $this->user,
            'starts_at' => $this->starts,
            'ends_at' => $this->ends,
        ];
    }
}
