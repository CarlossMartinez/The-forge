<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubclassSpellRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'subclass_id' => 'required|integer|exists:subclasses,id',
            'spell_id'    => 'required|integer|exists:spells,id',
        ];
    }
}
