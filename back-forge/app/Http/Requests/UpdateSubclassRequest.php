<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubclassRequest extends FormRequest
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
            'clase_id'    => 'sometimes|integer|exists:clases,id',
            'manual_code' => 'sometimes|string|exists:manuals,manual_code',
        ];
    }
}
