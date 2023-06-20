<?php

namespace Tests\Feature\GraphqlRequests;

use App\Mail\LaboratoryNotificationMail;
use App\Models\Consultation;
use App\Models\Doctor;
use App\Models\MedicalInvestigationType;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
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

    public function testDoctorCanUpdatePatientMedicalRecord()
    {
        $this->seed();

        Mail::fake();

        $consultation = Consultation::factory()->create();
        $investigationsIds = MedicalInvestigationType::whereNotNull('subgroup')
            ->inRandomOrder()
            ->take(8);

        $investigationsIds = $investigationsIds->pluck('id')
            ->flatten();

        $response = $this->actingAs((Doctor::first())->user)->graphQL(/** @lang GraphQL */ '
            mutation($input: MedicalRecordInput!) {
              addMedicalRecord(input: $input) {
                id
                consultation {
                  title
                }
              }
            }
         ', [
             'input' => [
                 'consultation_id' => $consultation->id,
                 'investigations' => $investigationsIds
             ]
        ]);

        Mail::assertSent(LaboratoryNotificationMail::class);

        $response->assertJsonStructure( [
            'data' => [
                'addMedicalRecord' => [
                    'id',
                    'consultation' => [
                        'title'
                    ]
                ]
            ]
        ]);
    }
}
