<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'                 => 'sometimes|string',
            'description'          => 'sometimes|string',
            'hit_die'              => 'sometimes|integer|in:4,6,8,10,12',
            'spellcaster'          => 'sometimes|boolean',
            'spellcasting_ability' => 'nullable|string|in:INT,WIS,CHA',
            'manual_code'          => 'sometimes|string|exists:manuals,manual_code',
        ];
    }
}
