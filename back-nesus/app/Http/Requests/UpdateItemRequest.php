<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|string',
            'description' => 'sometimes|string',
            'type'        => 'sometimes|string',
            'rarity'      => 'sometimes|string|in:Common,Uncommon,Rare,Very Rare,Legendary,Artifact',
            'weight'      => 'nullable|numeric|min:0',
            'value'       => 'nullable|numeric|min:0',
            'manual_code' => 'sometimes|string|exists:manuals,manual_code',
        ];
    }
}
