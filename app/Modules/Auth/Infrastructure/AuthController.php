<?php

namespace App\Modules\Auth\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Auth\Application\UseCases\RegisterUser;
use App\Modules\Auth\Application\UseCases\LoginUser;

class AuthController extends Controller
{
    protected $registerUser;
    protected $loginUser;

    public function __construct(RegisterUser $registerUser, LoginUser $loginUser)
    {
        $this->registerUser = $registerUser;
        $this->loginUser = $loginUser;
    }

    public function register(Request $request)
    {
        $result = $this->registerUser->execute($request->all());

        if (isset($result['errors'])) {
            return response()->json($result['errors'], 400);
        }

        return response()->json($result, 201);
    }

    public function login(Request $request)
    {
        $result = $this->loginUser->execute($request->only('email', 'password'));

        if (isset($result['error'])) {
            return response()->json($result, 401);
        }

        return response()->json($result, 200);
    }
}
