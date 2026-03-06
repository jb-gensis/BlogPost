<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use App\DTOs\AuthDTO;

interface UserRepositoryInterface
{
    public function create(AuthDTO $dto): User;

    public function findByEmail(string $email): ?User;
}
