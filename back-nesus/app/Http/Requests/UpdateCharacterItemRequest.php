<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCharacterItemRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'quantity'    => 'sometimes|integer|min:1',
            'is_equipped' => 'sometimes|boolean',
            'is_attuned'  => 'sometimes|boolean',
        ];
    }
}
