<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string',
            'description' => 'required|string',
            'type'        => 'required|string',
            'rarity'      => 'required|string|in:Common,Uncommon,Rare,Very Rare,Legendary,Artifact',
            'weight'      => 'nullable|numeric|min:0',
            'value'       => 'nullable|numeric|min:0',
            'manual_code' => 'required|string|exists:manuals,manual_code',
        ];
    }
}
