<?php

namespace App\Modules\Auth\Application\UseCases;

use Illuminate\Support\Facades\Auth;

class LoginUser
{
    public function execute(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if (!$user) {
                return ['error' => 'Unauthorized'];
            }

            $token = $user->createToken('LaravelPassport')->accessToken;

            return ['token' => $token];
        } else {
            return ['error' => 'Unauthorized'];
        }
    }
}
