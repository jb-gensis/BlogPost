<?php

namespace App\Repositories;

use App\Models\User;
use App\DTOs\AuthDTO;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function create(AuthDTO $dto): User
    {
        return User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password)
        ]);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email',$email)->first();
    }
}
