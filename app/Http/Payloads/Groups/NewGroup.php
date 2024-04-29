<?php

declare(strict_types=1);

namespace App\Http\Payloads\Groups;

final class NewGroup
{
    public function __construct(
        public string $name,
        public null|string $description,
        public null|string $icon,
        public string $user,
    ) {
    }

    /**
     * @return array{
     *     name: string,
     *     description:null|string,
     *     icon:null|string,
     *     user_id:string
     * }
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'icon' => $this->icon,
            'user_id' => $this->user,
        ];
    }
}
