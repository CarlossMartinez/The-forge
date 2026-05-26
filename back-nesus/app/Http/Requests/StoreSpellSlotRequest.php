<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpellSlotRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'character_id' => 'required|integer|exists:characters,id',
            'spell_level'  => 'required|integer|min:1|max:9',
            'slots_used'   => 'sometimes|integer|min:0',
        ];
    }
}
