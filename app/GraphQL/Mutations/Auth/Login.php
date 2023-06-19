<?php

namespace App\GraphQL\Mutations\Auth;

use App\Exceptions\GraphqlException;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Exceptions\AuthenticationException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

final class Login
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        if (Auth::attempt([
            'email' => Arr::pull($args, 'email'),
            'password' => Arr::pull($args, 'password'),
        ])) {
            $user = Auth::guard('sanctum')->user();

            $token = $user->createToken('authToken');


            return [
                'token' => $token->plainTextToken,
                'user' => $user,
                'token_type' => 'Bearer'
            ];
        }

        throw new GraphqlException('error', 'Wrong User Credentials');
    }
}
