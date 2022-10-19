<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateApi extends Middleware
{
    public function authenticate($request, array $guards)
    {
        $token = $request->query('api_token');

        if(empty($token)){
            $token = $request->input('api_token');
        }

        if(empty($token)){
            $token = $request->bearerToken();
        }

        if($token === config('app.name')) return;
        $this->unauthenticated($request,$guards);
    }
}
