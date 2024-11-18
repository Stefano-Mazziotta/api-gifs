<?php

namespace App\Modules\Auth\Application\UseCases;

use App\Modules\Auth\Domain\Models\User;
use Illuminate\Support\Facades\Validator;

class RegisterUser
{
    public function execute(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = $user->createToken('LaravelPassport')->accessToken;

        return ['token' => $token];
    }
}
