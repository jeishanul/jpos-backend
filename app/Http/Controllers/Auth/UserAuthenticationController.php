<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserAuthenticationController extends Controller
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    public function login(LoginRequest $request)
    {
        $user = $this->userRepository->firstByEmail($request->email);

        if ($user && Hash::check($request->password, $user->password)) {
            return $this->json('Signed in successfully', [
                'user' => new UserResource($user),
                'access' => $this->userRepository->getAccessToken($user),
            ]);
        }
        return $this->json('Credential is invalid!', [], 422);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->json('Signed out successfully');
    }
}