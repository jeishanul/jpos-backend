<?php

namespace App\Repositories;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;

class UserRepository extends Repository
{
    public static $path = "/user";
    /**
     * Get the model for the PHP function.
     *
     * @return string
     */
    public static function model()
    {
        return User::class;
    }
    /**
     * Retrieves the access token for the specified user.
     *
     * @param User $user The user for whom the access token is being retrieved
     * @return array The access token information including auth type, token, and expiration date
     */
    public static function getAccessToken(User $user)
    {
        $token = $user->createToken('user token');
        return [
            'auth_type' => 'Bearer',
            'token' => $token->accessToken,
            'expires_at' => $token->token->expires_at->format('Y-m-d H:i:s'),
        ];
    }
    /**
     * Update user profile and return the updated user.
     *
     * @param ProfileUpdateRequest $profileUpdateRequest description
     * @param User $user description
     * @return User
     */
    public static function profileUpdate(ProfileUpdateRequest $profileUpdateRequest, User $user): User
    {
        $mediaId = $user->media_id;
        if ($profileUpdateRequest->hasFile('image')) {
            $media = (new MediaRepository())->updateOrCreateByRequest(
                $profileUpdateRequest->image,
                self::$path,
                'Image'
            );
            $mediaId = $media->id;
        }

        self::update($user, [
            'name' => $profileUpdateRequest->name,
            'email' => $profileUpdateRequest->email,
            'phone_number' => $profileUpdateRequest->phone_number,
            'media_id' => $mediaId
        ]);

        return $user;
    }
    /**
     * Updates the user's password and returns the updated user.
     *
     * @param PasswordUpdateRequest $passwordUpdateRequest The request containing the new password
     * @param User $user The user whose password will be updated
     * @return User The updated user
     */
    public static function passwordUpdate(PasswordUpdateRequest $passwordUpdateRequest, User $user): User
    {
        self::update($user, [
            'password' => bcrypt($passwordUpdateRequest->password)
        ]);
        return $user;
    }
}
