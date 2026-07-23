<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'github_id' => 'nullable|integer|unique:users,github_id',
            'username'  => 'required|string|max:30|unique:users,username',
            'email'     => 'required|email|max:100|unique:users,email',
            'image'     => 'nullable|string|max:255',
            'role_id'   => 'required|integer|exists:roles,id',
        ];
    }
}
