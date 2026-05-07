<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpellRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|string',
            'description'  => 'required|string',
            'level'        => 'required|integer|min:0|max:9',
            'school'       => 'required|string',
            'casting_time' => 'required|string',
            'duration'     => 'required|string',
            'range'        => 'required|string',
            'components'   => 'required|string',
            'manual_code'  => 'required|string|exists:manuals,manual_code',
        ];
    }
}
