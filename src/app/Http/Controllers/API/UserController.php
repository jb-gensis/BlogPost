<?php

namespace App\Http\Controllers\API;

use App\DTOs\AuthDTO;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use App\Services\Interfaces\AuthServiceInterface;

class UserController extends BaseController
{
    public function __construct(
        protected AuthServiceInterface $authService
    ) {}

    public function signin(SigninRequest $request)
    {
        try {

            $dto = AuthDTO::fromArray($request->validated());

            $data = $this->authService->signin($dto);

            return $this->sendResponse($data,'User signed in');

        } catch (\Exception $e) {

            return $this->sendError(
                'Unauthorized User Account.',
                ['error'=>'Unauthorized User Account']
            );

        }
    }

    public function signup(SignupRequest $request)
    {
        $dto = AuthDTO::fromArray($request->validated());

        $data = $this->authService->signup($dto);

        return $this->sendResponse(
            $data,
            'User created successfully.'
        );
    }

    public function logout()
    {
        $this->authService->logout();

        return $this->sendResponse(null,'User Logged Out');
    }

    public function authenticate()
    {
        $check = $this->authService->authenticate();

        return $this->sendResponse($check,'User Authenticated');
    }
}
