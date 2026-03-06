<?php

namespace App\DTOs;

class BlogDTO
{
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?int $user_id = null
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'] ?? null,
            description: $data['description'] ?? null,
            user_id: $data['user_id'] ?? null
        );
    }
}
