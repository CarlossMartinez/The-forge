<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('userUpdateDestroy')->id ?? null; 
        return [
            'github_id' => 'nullable|integer|unique:users,github_id,' . $id,
            'username'  => 'sometimes|string|max:30|unique:users,username,' . $id,
            'email'     => 'sometimes|email|max:100|unique:users,email,' . $id,
            'image'     => 'nullable|string|max:255',
            'role_id'   => 'sometimes|integer|exists:roles,id',
        ];
    }
}
