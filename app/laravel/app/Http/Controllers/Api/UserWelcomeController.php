<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserWelcomeRequest;
use App\Http\Services\UserWelcomeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class UserWelcomeController extends Controller
{
    public function get(UserWelcomeRequest $request, UserWelcomeService $service): JsonResponse
    {
        $imageFileName = $service->getImageFileName($request->getEmail());
        return $service->makeResult($imageFileName);
    }
}
