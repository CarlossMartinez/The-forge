<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubraceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|string',
            'description' => 'sometimes|string',
            'race_id'     => 'sometimes|integer|exists:races,id',
            'manual_code' => 'sometimes|string|exists:manuals,manual_code',
        ];
    }
}
