<?php

namespace Tests\Feature\Api;

use App\Http\Repositories\UserSignUpRepository;
use App\Http\Services\UserSignUpService;
use Mockery;
use Tests\TestCase;

class SignUpTest extends TestCase
{
    public function test_signUp()
    {
        $repositoryMock = Mockery::mock(UserSignUpRepository::class);
        $repositoryMock->shouldReceive('getImageFileName')->andReturn('dummy.png');
        $repositoryMock->shouldReceive('save');

        $this->instance(
            UserSignUpService::class,
            new UserSignUpService($repositoryMock)
        );

        $response = $this->withoutMiddleware()->post(
            '/api/v1/user/sign-up',
            [
                'name' => 'ユーザー名',
                'email' => 'test@test.com',
                'imageUrl' => 'https://test/test.png'
            ]
        );

        $response->assertStatus(200);
        $response->assertJson([]);
    }
}
