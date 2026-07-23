<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubclassPassiveRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'subclass_id' => 'required|integer|exists:subclasses,id',
            'passive_id'  => 'required|integer|exists:passives,id',
        ];
    }
}
