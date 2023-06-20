<?php

namespace Tests\Feature\GraphqlRequests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MutationTest extends TestCase
{

    use DatabaseMigrations;
    use RefreshDatabase;

    public function testUserCanLogin()
    {
        $this->seed();

        $user = User::inRandomOrder()->first();

        $response = $this->graphQL(/** @lang GraphQL */ '
            mutation($email: String!, $password: String!) {
              login(email: $email, password: $password) {
                token
                token_type
                user {
                  id
                }
              }
            }
         ', [
             'email' => $user->email,
             'password' => "password",
        ]);

        $response->assertJsonStructure( [
            'data' => [
                'login' => [
                    'token',
                    'token_type',
                    'user' => [
                        'id'
                    ]
                ]
            ]
        ]);

        $response->assertJson( [
            'data' => [
                'login' => [
                    'token_type' => 'Bearer',
                    'user' => [
                        'id' => $user->id
                    ]
                ]
            ]
        ]);
    }
}
