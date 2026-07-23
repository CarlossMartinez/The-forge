<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRaceRequest extends FormRequest
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
            'manual_code' => 'required|string|exists:manuals,manual_code',
        ];
    }
}
