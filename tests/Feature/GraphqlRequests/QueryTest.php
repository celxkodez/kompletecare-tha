<?php

namespace Tests\Feature\GraphqlRequests;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QueryTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function testFetchAllUsers()
    {
        $this->seed();

         $response = $this->graphQL(/** @lang GraphQL */ '
            query {
              users {
                data {
                  email
                }
              }
            }
         ');
         $response->assertJsonIsArray( "data.users.data");
         $this->assertGreaterThan(3, count($response->json()['data']['users']['data']));
    }

    public function testUserCanQueryInvestigationGroup()
    {
        $this->seed();

        $response = $this->actingAs((Doctor::first())->user)->graphQL(/** @lang GraphQL */ '
            query {
              investigationGroups {
                id
                name
                subgroup
                children {
                  id
                  name
                  subgroup
                }
              }
            }
         ');

        $response->assertJsonStructure( [
            'data' => [
                'investigationGroups' => [
                   [
                       'id',
                       'name',
                       'subgroup',
                       'children' => [
                           [
                               'id',
                               'name',
                               'subgroup'
                           ]
                       ]
                   ]
                ]
            ]
        ]);
    }
}
