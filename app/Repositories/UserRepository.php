<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    public function model()
    {
        return User::class;
    }

    public function firstByEmail($email)
    {
        return $this->query()->where('email', $email)->first();
    }

    public function getAccessToken(User $user)
    {
        $token = $user->createToken('user token');

        return [
            'auth_type' => 'Bearer',
            'token' => $token->accessToken,
            'expires_at' => $token->token->expires_at->format('Y-m-d H:i:s'),
        ];
    }
}
