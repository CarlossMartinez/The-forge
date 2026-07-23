<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCharacterFeatRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'character_id' => 'required|integer|exists:characters,id',
            'feat_id'      => 'required|integer|exists:feats,id',
        ];
    }
}
