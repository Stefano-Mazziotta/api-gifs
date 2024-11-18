<?php

namespace App\Modules\Auth\Infrastructure;

use App\Controller;
use App\Modules\Auth\Infrastructure\RegisterUserRequest;
use Illuminate\Http\Request;
use App\Modules\Auth\Application\LoginUser;
use App\Modules\Auth\Application\RegisterUser;

class AuthController extends Controller
{
    protected $_login;
    protected $_register;

    public function __construct(LoginUser $login, RegisterUser $register)
    {
        $this->_login = $login;
        $this->_register = $register;
    }

    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();

        $result = $this->_register->execute($data);

        if (isset($result['error'])) {
            return response()->json($result, 400);
        }

        return response()->json($result, 201);
    }

    public function login(LoginUserRequest $request)
    {

        $data = $request->validated();

        $result = $this->_login->execute($data);

        if (isset($result['error'])) {
            return response()->json($result, 401);
        }

        return response()->json($result, 200);
    }
}
