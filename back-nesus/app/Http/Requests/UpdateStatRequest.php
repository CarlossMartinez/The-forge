<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|string',
            'description' => 'sometimes|string',
            'manual_code' => 'sometimes|string|exists:manuals,manual_code',
        ];
    }
}
