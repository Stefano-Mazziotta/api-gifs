<?php

namespace App\Modules\Auth\Application;

use App\Modules\Auth\Domain\Models\User;


class RegisterUser
{
    public function execute(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = $user->createToken('LaravelPassport')->accessToken;

        return ['token' => $token];
    }
}
