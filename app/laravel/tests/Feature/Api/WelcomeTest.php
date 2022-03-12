<?php

namespace Tests\Feature\Api;

use App\Http\Repositories\UserWelcomeRepository;
use App\Http\Services\UserWelcomeService;
use Mockery;
use Tests\TestCase;

class WelcomeTest extends TestCase
{
    public function test()
    {
        $repositoryMock = Mockery::mock(UserWelcomeRepository::class);
        $repositoryMock->shouldReceive('getImageFileName')->andReturn('dummy.png');

        $this->instance(
            UserWelcomeService::class,
            new UserWelcomeService($repositoryMock)
        );

        $response = $this->withoutMiddleware()->get(
            '/api/v1/user/welcome?email=test@test.com'
        );

        $response->assertStatus(200);
        $response->assertJson(
            [
                'welcomeImage' => [
                    'path' => 'http://localhost/storage/dummy.png'
                ]
            ]
        );
    }
}
