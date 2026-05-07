<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCharacterPassiveRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'character_id' => 'required|integer|exists:characters,id',
            'passive_id'   => 'required|integer|exists:passives,id',
        ];
    }
}
