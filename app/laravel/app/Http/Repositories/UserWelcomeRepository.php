<?php
declare(strict_types=1);

namespace App\Http\Repositories;

use App\Models\User;

class UserWelcomeRepository
{
    public function getImageFileName(string $email): string
    {
        return collect(User::firstWhere('email', $email))->get('image_file_name');
    }
}
