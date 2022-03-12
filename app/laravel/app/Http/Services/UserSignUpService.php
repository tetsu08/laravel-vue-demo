<?php
declare(strict_types=1);

namespace App\Http\Services;

use App\Http\Repositories\UserSignUpRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserSignUpService
{
    private UserSignUpRepository $repository;

    public function __construct(UserSignUpRepository $repository = null)
    {
        $this->repository = $repository ?? app(UserSignUpRepository::class);
    }

    public function signUp(string $name, string $email, string $imageUrl): void
    {
        $imageFileName = $this->repository->getImageFileName($name, $imageUrl);
        $this->repository->save($name, $email, $imageFileName);
    }

    public function makeResult(): JsonResponse
    {
        return response()->json([], Response::HTTP_OK);
    }
}
