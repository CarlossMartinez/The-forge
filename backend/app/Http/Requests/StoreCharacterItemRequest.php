<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCharacterItemRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'character_id' => 'required|integer|exists:characters,id',
            'item_id'      => 'required|integer|exists:items,id',
            'quantity'     => 'sometimes|integer|min:1',
            'is_equipped'  => 'sometimes|boolean',
            'is_attuned'   => 'sometimes|boolean',
        ];
    }
}
