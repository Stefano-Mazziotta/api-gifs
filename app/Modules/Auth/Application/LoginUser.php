<?php

namespace App\Modules\Auth\Application;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;

class LoginUser
{
    public function execute(Request $request)
    {
        $client = Client::where('password_client', 1)->first();

        $request->request->add([
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $request->username,
            'password' => $request->password,
            'scope' => '',
        ]);

        $tokenRequest = Request::create(
            'oauth/token',
            'post'
        );

        $response = app()->handle($tokenRequest);

        return json_decode($response->getContent(), true);
    }
}
