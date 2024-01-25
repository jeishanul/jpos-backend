<?php

namespace App\Repositories;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
{
    public static $path = "/user";
    public static function model()
    {
        return User::class;
    }
    public static function firstByEmail($email)
    {
        return self::query()->where('email', $email)->first();
    }
    public static function getAccessToken(User $user)
    {
        $token = $user->createToken('user token');
        return [
            'auth_type' => 'Bearer',
            'token' => $token->accessToken,
            'expires_at' => $token->token->expires_at->format('Y-m-d H:i:s'),
        ];
    }
    public static function profileUpdate(ProfileUpdateRequest $profileUpdateRequest, User $user): User
    {
        self::update($user, [
            'name' => $profileUpdateRequest->name,
            'email' => $profileUpdateRequest->email,
            'phone_number' => $profileUpdateRequest->phone_number
        ]);

        return $user;
    }
    public static function passwordUpdate(PasswordUpdateRequest $passwordUpdateRequest, User $user): User
    {
        self::update($user, [
            'password' => Hash::make($passwordUpdateRequest->password)
        ]);
        return $user;
    }
}
