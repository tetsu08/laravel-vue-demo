<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserSignUpRequest;
use App\Http\Services\UserSignUpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class UserSignUpController extends Controller
{
    public function post(UserSignUpRequest $request, UserSignUpService $service): JsonResponse
    {
        $service->signUp($request->getName(), $request->getEmail(), $request->getImageUrl());
        return $service->makeResult();
    }
}
