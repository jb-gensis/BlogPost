<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\DTOs\AuthDTO;
use App\Services\Interfaces\AuthServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function signin(AuthDTO $dto)
    {
        if (!Auth::attempt([
            'email' => $dto->email,
            'password' => $dto->password
        ])) {
            throw new \Exception('Unauthorized User Account.');
        }

        $user = Auth::user();

        return [
            'token' => $user->createToken('MyAuthApp')->plainTextToken,
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ];
    }

    public function signup(AuthDTO $dto)
    {
        $user = $this->userRepository->create($dto);

        return [
            'token' => $user->createToken('MyAuthApp')->plainTextToken,
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ];
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
    }

    public function authenticate()
    {
        return auth('sanctum')->check();
    }
}
