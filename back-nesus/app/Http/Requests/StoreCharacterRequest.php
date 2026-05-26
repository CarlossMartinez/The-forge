<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class StoreCharacterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|string',
            'description'  => 'sometimes|string',
            'level'        => 'sometimes|integer|min:1|max:20',
            'experience'   => 'sometimes|integer|min:0',
            'hp_max'       => 'integer|min:1',
            'hp_current'   => 'integer|min:0',
            'hp_temp'      => 'integer|min:0',
            'alignment'    => 'required|string',
            'image'        => 'nullable|string|max:255',
            'user_id'      => 'required|integer|exists:users,id',
            'race_id'      => 'nullable|integer|exists:races,id',
            'subrace_id'   => 'nullable|integer|exists:subraces,id',
            'background_id'=> 'nullable|integer|exists:backgrounds,id',
            'clase_id'     => 'required|integer|exists:clases,id',
            'subclass_id'  => 'nullable|integer|exists:subclasses,id',
            'manual_code' => 'nullable|string|exists:manuals,manual_code',        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Error de validación',
                'errors'  => $validator->errors()
            ], 422)
        );
    }
}
