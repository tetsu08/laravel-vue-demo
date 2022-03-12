<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSignUpRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'email' => 'required|email|max:100',
            'imageUrl' => 'required|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザー名は必須です',
            'name.max' => 'ユーザー名が50文字を超えています',
            'email.required' => 'メールアドレスは必須です',
            'email.email' => 'メールアドレスの形式が不正です',
            'email.max' => 'メールアドレスは100文字を超えています',
            'imageUrl.required' => '画像URLは必須です',
            'imageUrl.max' => '画像URLは100文字を超えています'
        ];
    }

    public function getName(): string
    {
        return $this->input('name');
    }

    public function getEmail(): string
    {
        return $this->input('email');
    }

    public function getImageUrl(): string
    {
        return $this->input('imageUrl');
    }
}
