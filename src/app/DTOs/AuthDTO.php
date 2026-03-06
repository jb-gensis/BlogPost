<?php

namespace App\DTOs;

class AuthDTO
{
    public function __construct(
        public ?string $name = null,
        public string $email,
        public string $password
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? null,
            email: $data['email'],
            password: $data['password']
        );
    }
}
