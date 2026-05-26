<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBackgroundProeficiencyRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'background_id'    => 'required|integer|exists:backgrounds,id',
            'proeficiencie_id' => 'required|integer|exists:proeficiencies,id',
        ];
    }
}
