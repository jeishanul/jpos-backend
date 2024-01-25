<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profileUpdate(ProfileUpdateRequest $profileUpdateRequest)
    {
        $user = auth()->user();
        $user = UserRepository::profileUpdate($profileUpdateRequest, $user);
        return $this->json('Profile update successfully updated', [
            'user' => UserResource::make($user),
        ]);
    }
    public function passwordUpdate(PasswordUpdateRequest $passwordUpdateRequest)
    {
        $user = auth()->user();
        UserRepository::passwordUpdate($passwordUpdateRequest, $user);
        return $this->json('Password successfully updated');
    }
}
