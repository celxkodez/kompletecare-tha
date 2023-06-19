<?php

namespace App\GraphQL\Mutations\Auth;

use App\Exceptions\GraphqlException;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class Logout
{
    /**
     * @param null $_
     * @param array{} $args
     * @throws GraphqlException
     */
    public function __invoke($_, array $args, GraphQLContext $context,)
    {
        $token = $context->request->bearerToken();
        if(!$token) {
            throw new GraphqlException("missing authorization token", "You need to set an authorization token");
        }
        $user = Auth::user();

        $user->tokens()->delete();

        return [
            'status'  => 'success',
            'message' => __('Your session has been terminated'),
        ];
    }
}
