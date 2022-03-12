<?php
declare(strict_types=1);

namespace App\Http\Services;

use App\Http\Repositories\UserWelcomeRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserWelcomeService
{
    private UserWelcomeRepository $repository;

    public function __construct(UserWelcomeRepository $repository = null)
    {
        $this->repository = $repository ?? app(UserWelcomeRepository::class);
    }

    public function getImageFileName(string $email): string
    {
        return $this->repository->getImageFileName($email);
    }

    public function makeResult(string $imageFileName): JsonResponse
    {
        return response()->json(
            collect()->put('welcomeImage', collect()->put('path', url('storage/' . $imageFileName)))->toArray(),
            Response::HTTP_OK
        );
    }
}
