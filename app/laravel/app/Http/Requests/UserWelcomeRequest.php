<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserWelcomeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスは必須です'
        ];
    }

    public function getEmail(): string
    {
        return $this->input('email');
    }
}
