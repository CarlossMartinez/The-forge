<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'                 => 'required|string',
            'description'          => 'required|string',
            'hit_die'              => 'required|integer|in:4,6,8,10,12',
            'spellcaster'          => 'required|boolean',
            'spellcasting_ability' => 'nullable|string|in:INT,WIS,CHA',
            'manual_code'          => 'required|string|exists:manuals,manual_code',
        ];
    }
}
