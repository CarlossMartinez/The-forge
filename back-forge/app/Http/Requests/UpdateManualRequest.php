<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManualRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $manualCode = $this->route('manual');

        return [
            'name'        => 'sometimes|string|unique:manuals,name,' . $manualCode . ',manual_code',
            'description' => 'sometimes|string',
            'system'      => 'sometimes|string',
            'manual_type' => 'sometimes|string|in:Hombrew,Oficial,Premium',
            'is_active'   => 'sometimes|boolean',
            'user_id'     => 'sometimes|exists:users,id',
        ];
    }
}
