<?php

namespace App\Modules\Auth\Application;

use App\Modules\Auth\Domain\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginUser
{
    const LOCAL_CLIENT_NAME = 'app';

    public function execute(array $data)
    {
        // Retrieve the authenticated user
        $user = User::where('email', $data['email'])->first();

        // Check if the user exists
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return ['error' => 'The provided credentials are incorrect.'];
        }

        // Generate a new personal access token for the user
        $tokenResult = $user->createToken('LaravelPassport');
        $token = $tokenResult->token;

        // Save the token
        $token->save();

        // Return the token details
        return [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => $tokenResult->token->expires_at,
        ];
    }
}
