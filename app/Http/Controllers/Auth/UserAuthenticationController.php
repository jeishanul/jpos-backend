<?php

namespace App\Http\Controllers\Auth;

use App\Events\MailSendEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordResets;
use App\Http\Requests\PasswordResetsTokenCheck;
use App\Http\Requests\PasswordUpdateRequest;
use App\Repositories\UserRepository;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserAuthenticationController extends Controller
{
    public function login(LoginRequest $loginRequest)
    {
        $credentials = $loginRequest->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return $this->json('Signed in successfully', [
                'user' => new UserResource($user),
                'access' => UserRepository::getAccessToken($user),
            ]);
        }
        return $this->json('Credential is invalid!', [], 422);
    }
    public function passwordResets(PasswordResets $passwordResets)
    {
        $token = random_int(100000, 999999);
        DB::table('password_reset_tokens')->insert([
            'email' => $passwordResets->email,
            'token' => $token,
        ]);

        MailSendEvent::dispatch($passwordResets->email, $token);

        return $this->json('Recovery email successfully send', []);
    }
    public function tokenCheck(PasswordResetsTokenCheck $passwordResetsTokenCheck)
    {
        $passwordResetTokens = DB::table('password_reset_tokens')->where('email', $passwordResetsTokenCheck->email)->first();

        if ($passwordResetTokens->token != $passwordResetsTokenCheck->token) {
            return $this->json('Credential is invalid token!', [], 422);
        }

        return $this->json('Token successfully verified', [
            'token' => $passwordResetTokens->token,
        ]);
    }
    public function passwordUpdate(PasswordUpdateRequest $passwordUpdateRequest)
    {
        $passwordResetTokens = DB::table('password_reset_tokens')->where('token', $passwordUpdateRequest->token)->first();
        if (!$passwordResetTokens) {
            return $this->json('Credential is invalid token!', [], 422);
        }
        $user = UserRepository::query()->where('email', $passwordResetTokens->email)->first();
        UserRepository::passwordUpdate($passwordUpdateRequest, $user);
        DB::table('password_reset_tokens')->where('token', $passwordUpdateRequest->token)->delete();
        return $this->json('Your password is changed successfully.');
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->json('Signed out successfully');
    }
}
