<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreManualRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'manual_code' => 'required|string|unique:manuals,manual_code',
            'name'        => 'required|string',
            'description' => 'required|string',
            'system'      => 'sometimes|string',
            'manual_type' => 'sometimes|string|in:Hombrew,Oficial,Premium',
            'is_active'   => 'sometimes|boolean',
            'user_id'     => 'sometimes|exists:users,id',
        ];
    }
}
