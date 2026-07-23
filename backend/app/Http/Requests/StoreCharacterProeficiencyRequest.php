<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCharacterProeficiencyRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'character_id'    => 'required|integer|exists:characters,id',
            'proeficiencie_id' => 'required|integer|exists:proeficiencies,id',
        ];
    }
}
