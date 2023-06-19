<?php

namespace App\GraphQL\Mutations;

use App\Exceptions\GraphqlException;
use App\Models\Consultation;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Arr;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class MedicalRecord
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }

    /**
     * @param $root
     * @param array $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     * @return mixed
     * @throws GraphqlException
     */
    public function add($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        try {
            $consultation = Consultation::findOrFail($args['consultation_id']);

            $investigations = $args['investigations'] ?? [];
            $id = $args['id'] ?? null;

            $medicalRecord = $consultation->medicalRecords()->updateOrCreate(['id' => $id], $args);

            $medicalRecord->investigationTypes()->sync($investigations);

            return $medicalRecord;
        } catch (\Throwable $exception) {
            logger($exception);
            throw new GraphqlException('error', 'Sorry An Error Occurred!');
        }
    }
}
