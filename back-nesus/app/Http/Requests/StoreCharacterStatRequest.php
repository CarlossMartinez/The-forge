<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCharacterStatRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'character_id' => 'required|integer|exists:characters,id',
            'stat_id'      => 'required|integer|exists:stats,id',
            'value'        => 'required|integer|min:1|max:30',
        ];
    }
}
