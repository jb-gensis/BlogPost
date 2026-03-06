<?php

namespace App\Services\Interfaces;

use App\DTOs\AuthDTO;

interface AuthServiceInterface
{
    public function signin(AuthDTO $dto);

    public function signup(AuthDTO $dto);

    public function logout();

    public function authenticate();
}
