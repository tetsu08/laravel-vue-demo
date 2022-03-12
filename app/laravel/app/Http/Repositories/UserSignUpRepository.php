<?php
declare(strict_types=1);

namespace App\Http\Repositories;

use App\Http\Builders\ImageBuilder;
use App\Models\User;

class UserSignUpRepository
{
    private ImageBuilder $builder;

    public function __construct(ImageBuilder $builder = null)
    {
        $this->builder = $builder ?? app(ImageBuilder::class);
    }

    public function getImageFileName(string $name, string $imageUrl): string
    {
        return $this->builder->generateWelcomeImage($name, $imageUrl)->getImageFileName();
    }

    public function save(string $name, string $email, string $imageFileName): void
    {
        User::updateOrCreate(
            [
                'email' => $email
            ],
            [
                'name' => $name,
                'email' => $email,
                'image_file_name' => $imageFileName
            ]
        );
    }
}
