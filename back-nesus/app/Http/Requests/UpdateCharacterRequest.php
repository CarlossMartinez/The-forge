<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCharacterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => 'sometimes|string',
            'description'   => 'sometimes|string',
            'level'         => 'sometimes|integer|min:1|max:20',
            'experience'    => 'sometimes|integer|min:0',
            'hp_max'        => 'sometimes|integer|min:1',
            'hp_current'    => 'sometimes|integer|min:0',
            'hp_temp'       => 'sometimes|integer|min:0',
            'alignment'     => 'sometimes|string',
            'image'         => 'nullable|string|max:255',
            'enabled'       => 'sometimes|boolean',
            'race_id'       => 'nullable|integer|exists:races,id',
            'subrace_id'    => 'nullable|integer|exists:subraces,id',
            'background_id' => 'nullable|integer|exists:backgrounds,id',
            'clase_id'      => 'sometimes|integer|exists:clases,id',
            'subclass_id'   => 'nullable|integer|exists:subclasses,id',
            'manual_code'   => 'sometimes|string|exists:manuals,manual_code',
        ];
    }
}
