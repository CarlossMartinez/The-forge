<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpellRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => 'sometimes|string',
            'description'  => 'sometimes|string',
            'level'        => 'sometimes|integer|min:0|max:9',
            'school'       => 'sometimes|string',
            'casting_time' => 'sometimes|string',
            'duration'     => 'sometimes|string',
            'range'        => 'sometimes|string',
            'components'   => 'sometimes|string',
            'manual_code'  => 'sometimes|string|exists:manuals,manual_code',
        ];
    }
}
