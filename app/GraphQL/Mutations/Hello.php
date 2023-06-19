<?php

namespace App\GraphQL\Mutations;

final class Hello
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return [
            'status' => 'success',
            'message' => "Welcome"
        ];
    }
}
