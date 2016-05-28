<?php

namespace Nuwave\Lighthouse\Tests\Queries;

use Nuwave\Lighthouse\Tests\TestCase;
use Nuwave\Lighthouse\Tests\Support\GraphQL\Types\UserType;
use Nuwave\Lighthouse\Tests\Support\GraphQL\Types\TaskType;
use Nuwave\Lighthouse\Tests\Support\GraphQL\Mutations\UpdateEmailMutation;

class MutationTest extends TestCase
{
    /**
     * @test
     */
    public function itCanResolveMutation()
    {
        $query = 'mutation UpdateUserEmail {
            updateEmail(id: "foo", email: "foo@bar.com") {
                email
            }
        }';

        $expected = [
            'updateEmail' => [
                'email' => 'foo@bar.com'
            ]
        ];

        $graphql = app('graphql');
        $graphql->schema()->type('user', UserType::class);
        $graphql->schema()->type('task', TaskType::class);
        $graphql->schema()->mutation('updateEmail', UpdateEmailMutation::class);

        $this->assertEquals(['data' => $expected], $this->executeQuery($query));
    }
}