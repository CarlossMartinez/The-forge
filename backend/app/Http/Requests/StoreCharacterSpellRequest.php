<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCharacterSpellRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'character_id' => 'required|integer|exists:characters,id',
            'spell_id'     => 'required|integer|exists:spells,id',
            'is_prepared'  => 'sometimes|boolean',
        ];
    }
}
