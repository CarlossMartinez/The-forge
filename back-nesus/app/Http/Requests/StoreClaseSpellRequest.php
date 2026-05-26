<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClaseSpellRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'clase_id' => 'required|integer|exists:clases,id',
            'spell_id' => 'required|integer|exists:spells,id',
        ];
    }
}
