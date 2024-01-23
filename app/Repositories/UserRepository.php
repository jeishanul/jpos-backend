<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    public static $path = "/users";
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
}
