<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubclassRequest extends FormRequest
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
            'clase_id'    => 'required|integer|exists:clases,id',
            'manual_code' => 'required|string|exists:manuals,manual_code',
        ];
    }
}
